"""Helper: rename generated image and update DB for a product."""
import sqlite3, os, sys, shutil, glob

os.chdir('D:/laragon/www/ms2')
PRODUCTS_DIR = 'public/images/products'

# Product name -> safe filename mapping
def safe_name(name):
    return name.lower().replace(' ', '-').replace('/', '-').replace('&', 'and').replace('--', '-').strip('-')

def process(product_id, product_name, source_file=None, is_hero=False):
    """Rename a PNG and update DB. If source_file given, use it directly; else find latest PNG."""
    conn = sqlite3.connect('database/database.sqlite')
    cur = conn.cursor()
    
    filename = safe_name(product_name)
    if is_hero:
        filename += '-hero'
    filename += '.jpg'
    
    if source_file:
        src = os.path.join(PRODUCTS_DIR, source_file)
        if not os.path.exists(src):
            print(f'ERROR: Source file not found: {src}')
            conn.close()
            return False
        latest = src
    else:
        png_files = glob.glob(os.path.join(PRODUCTS_DIR, '*.png'))
        if not png_files:
            print(f'ERROR: No PNG files found for product {product_id}')
            conn.close()
            return False
        latest = max(png_files, key=os.path.getmtime)
    dest = os.path.join(PRODUCTS_DIR, filename)
    
    # Move/rename
    shutil.move(latest, dest)
    print(f'Renamed: {os.path.basename(latest)} -> {filename}')
    
    # Update DB
    db_path = f'images/products/{filename}'
    if is_hero:
        cur.execute('UPDATE products SET hero_image=? WHERE id=?', (db_path, product_id))
    else:
        cur.execute('UPDATE products SET image=?, hero_image=? WHERE id=?', (db_path, db_path, product_id))
    
    conn.commit()
    cur.execute('SELECT id, name, image, hero_image FROM products WHERE id=?', (product_id,))
    r = cur.fetchone()
    print(f'  DB [{r[0]}] {r[1]}: img={r[2]}, hero={r[3]}')
    conn.close()
    return True

if __name__ == '__main__':
    if len(sys.argv) < 3:
        print('Usage: python rename_and_update.py <product_id> <product_name> [source_file] [--hero]')
        sys.exit(1)
    pid = int(sys.argv[1])
    name = sys.argv[2]
    is_hero = '--hero' in sys.argv
    source = None
    for arg in sys.argv[3:]:
        if arg == '--hero':
            is_hero = True
        elif not arg.startswith('--'):
            source = arg
    process(pid, name, source, is_hero)
