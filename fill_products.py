import sqlite3
import json
from datetime import datetime

conn = sqlite3.connect('database/database.sqlite')
c = conn.cursor()

# Get all categories that need products
c.execute("""
    SELECT id, slug, name, category_group 
    FROM categories 
    WHERE slug IN (
        'vinyl-stickers', 'pet-labels', 'pp-labels', 'kraft-labels', 'foil-labels', 'transparent-labels',
        'brewery-labels', 'cosmetic-labels', 'food-beverage-labels', 'pharma-labels', 'cannabis-labels', 'amazon-labels',
        'die-cut-stickers', 'kiss-cut-stickers', 'circle-stickers', 'rectangle-stickers', 'square-stickers', 'custom-shape-stickers'
    )
    ORDER BY category_group, name
""")
categories = c.fetchall()

print(f"Found {len(categories)} categories to populate")

# Products template for each category
products_by_category_type = {
    # Material categories
    'vinyl-stickers': [
        ('Outdoor Vinyl Stickers', 'outdoor-vinyl-stickers', 'Weatherproof vinyl stickers for outdoor use. UV resistant, waterproof, and durable for 5+ years.', 'Premium outdoor vinyl stickers engineered to withstand harsh weather conditions. Perfect for equipment labels, outdoor signage, and vehicle decals.'),
        ('White Vinyl Stickers', 'white-vinyl-stickers', 'Classic white vinyl stickers with excellent print quality. Ideal for product labels and branding.', 'Our white vinyl stickers provide a clean, professional look with vibrant color reproduction. Suitable for indoor and outdoor use.'),
        ('Clear Vinyl Stickers', 'clear-vinyl-stickers', 'Crystal clear vinyl stickers with a no-label look. Perfect for glass and plastic surfaces.', 'Clear vinyl stickers offer a seamless look on any surface. The adhesive creates a strong bond while remaining residue-free when removed.'),
        ('Removable Vinyl Stickers', 'removable-vinyl-stickers', 'Temporary vinyl stickers that can be removed without leaving residue. Great for seasonal promotions.', 'Our removable vinyl stickers are perfect for temporary applications like window displays, seasonal promotions, and event branding.'),
        ('High-Tack Vinyl Stickers', 'high-tack-vinyl-stickers', 'Extra-strong adhesive vinyl stickers for rough surfaces like plastic buckets and metal containers.', 'High-tack vinyl stickers bond strongly to challenging surfaces including textured plastics, metals, and painted surfaces.'),
    ],
    'pet-labels': [
        ('Premium PET Labels', 'premium-pet-labels', 'Crystal-clear PET material for premium product labeling. Excellent chemical and temperature resistance.', 'Our premium PET labels offer exceptional clarity and durability for high-end product packaging.'),
        ('Waterproof PET Labels', 'waterproof-pet-labels', 'Durable waterproof PET labels suitable for products exposed to moisture and liquids.', 'Waterproof PET labels resist water, oil, and chemicals while maintaining excellent print quality.'),
        ('Chemical Resistant PET Labels', 'chemical-resistant-pet-labels', 'PET labels designed to withstand exposure to chemicals and cleaning products.', 'Engineered for chemical resistance, these PET labels are ideal for cleaning products and industrial applications.'),
        ('Freezer Grade PET Labels', 'freezer-grade-pet-labels', 'Cold-resistant PET labels suitable for freezer and refrigeration applications.', 'These PET labels maintain adhesion and readability even at freezer temperatures down to -40C.'),
        ('Transparent PET Labels', 'transparent-pet-labels', 'No-label look PET labels that seamlessly blend with your packaging.', 'Crystal clear PET labels create a premium no-label look perfect for cosmetics and beverages.'),
    ],
    'pp-labels': [
        ('Flexible PP Labels', 'flexible-pp-labels', 'Flexible PP material for squeezable containers and curved surfaces.', 'Our flexible PP labels conform perfectly to squeezable bottles and curved containers.'),
        ('Food Safe PP Labels', 'food-safe-pp-labels', 'FDA-compliant food-safe PP labels for packaging and containers.', 'Food-safe PP labels meet FDA requirements for direct food contact applications.'),
        ('Squeeze Bottle PP Labels', 'squeeze-bottle-pp-labels', 'PP labels specifically designed for squeeze bottles and tubes.', 'These PP labels flex with squeeze bottles without cracking or peeling.'),
        ('White PP Labels', 'white-pp-labels', 'Opaque white PP labels for products requiring a solid background.', 'White PP labels provide excellent opacity and color contrast for product labels.'),
        ('Economy PP Labels', 'economy-pp-labels', 'Cost-effective PP labels for high-volume applications.', 'Our economy PP labels offer a great balance of quality and affordability.'),
    ],
    'kraft-labels': [
        ('Natural Kraft Labels', 'natural-kraft-labels', 'Eco-friendly brown kraft paper labels for natural and artisanal products.', 'Give your products an organic, handcrafted feel with our natural kraft paper labels.'),
        ('Recycled Kraft Labels', 'recycled-kraft-labels', 'Made from 100% recycled materials for sustainable packaging.', 'Our recycled kraft labels support your eco-friendly brand values.'),
        ('Kraft Jar Labels', 'kraft-jar-labels', 'Kraft labels perfect for mason jars, honey jars, and craft beverages.', 'These durable kraft labels adhere well to glass jars and resist moisture.'),
        ('Vintage Kraft Labels', 'vintage-kraft-labels', 'Rustic vintage-style kraft labels for craft and artisanal products.', 'Add a vintage touch to your product labels with our rustic kraft designs.'),
        ('Compostable Kraft Labels', 'compostable-kraft-labels', 'Fully compostable kraft labels for zero-waste packaging.', 'Our compostable kraft labels break down completely in commercial composting facilities.'),
    ],
    'foil-labels': [
        ('Gold Foil Labels', 'gold-foil-labels', 'Luxurious gold metallic foil labels that make your products stand out.', 'Premium gold foil labels add elegance and sophistication to any product.'),
        ('Silver Foil Labels', 'silver-foil-labels', 'Sleek silver metallic foil labels for a modern premium look.', 'Silver foil labels provide a contemporary, high-end appearance.'),
        ('Holographic Foil Labels', 'holographic-foil-labels', 'Rainbow holographic foil labels that shimmer and shine.', 'Holographic foil labels catch the light and create a stunning visual effect.'),
        ('Colored Foil Labels', 'colored-foil-labels', 'Custom colored foil labels in rose gold, copper, blue, and more.', 'Choose from our range of colored foil options to match your brand.'),
        ('Black Foil Labels', 'black-foil-labels', 'Bold black foil labels for dramatic, high-contrast designs.', 'Black foil labels create a striking visual impact for premium products.'),
    ],
    'transparent-labels': [
        ('Clear Transparent Labels', 'clear-transparent-labels', 'Crystal clear transparent labels for a seamless no-label look.', 'Our clear transparent labels blend invisibly with your packaging.'),
        ('Frosted Transparent Labels', 'frosted-transparent-labels', 'Elegant frosted glass effect transparent labels.', 'Frosted transparent labels add a sophisticated frosted glass appearance.'),
        ('Window Sticker Labels', 'window-sticker-labels', 'Transparent labels perfect for glass window applications.', 'These labels work great on glass windows, mirrors, and storefronts.'),
        ('Cosmetic Transparent Labels', 'cosmetic-transparent-labels', 'Premium transparent labels designed for cosmetics packaging.', 'Our cosmetic transparent labels enhance the beauty of your product packaging.'),
        ('Water Bottle Transparent Labels', 'water-bottle-transparent-labels', 'Transparent labels designed for water bottles and drink containers.', 'These durable transparent labels withstand condensation and moisture.'),
    ],
    
    # Industry categories
    'brewery-labels': [
        ('Beer Bottle Labels', 'beer-bottle-labels', 'Waterproof beer bottle labels designed to withstand cold refrigeration.', 'Our brewery labels are engineered to endure cold storage while maintaining vibrant graphics.'),
        ('Craft Beer Labels', 'craft-beer-labels', 'Creative craft beer labels that tell your brewery story.', 'Eye-catching craft beer labels that stand out on tap handles and bottle necks.'),
        ('Wine Bottle Labels', 'wine-bottle-labels', 'Premium wine bottle labels with elegant designs and water resistance.', 'Wine labels that maintain their beauty through refrigeration and ice buckets.'),
        ('Cider Labels', 'cider-labels', 'Crisp, clean labels for hard cider and fermented beverages.', 'Cider labels designed to match the refreshing nature of your product.'),
        ('Brewery Can Labels', 'brewery-can-labels', 'Waterproof labels for aluminum beer cans and growlers.', 'Our can labels withstand condensation and cold temperatures perfectly.'),
    ],
    'cosmetic-labels': [
        ('Lip Balm Labels', 'lip-balm-labels', 'Compact labels designed for lip balm tubes and mini containers.', 'Perfect fit labels for lip balm tubes from 10mm to 15mm diameter.'),
        ('Serum Bottle Labels', 'serum-bottle-labels', 'Premium labels for serum and essential oil bottles.', 'Our serum labels are compatible with glass dropper bottles and pump dispensers.'),
        ('Skincare Jar Labels', 'skincare-jar-labels', 'Elegant labels for cream jars and cosmetic containers.', 'Skincare jar labels that maintain adhesion on smooth and textured surfaces.'),
        ('Shampoo Bottle Labels', 'shampoo-bottle-labels', 'Waterproof labels for shampoo, conditioner, and body wash bottles.', 'These labels withstand bathroom humidity and shower conditions.'),
        ('Makeup Palette Labels', 'makeup-palette-labels', 'Compact labels for eyeshadow, blush, and contour palettes.', 'Perfect for professional makeup artist branding and retail packaging.'),
    ],
    'food-beverage-labels': [
        ('Jam Jar Labels', 'jam-jar-labels', 'Moisture-resistant labels for jam, jelly, and preserve jars.', 'Our jam labels stay put even in the refrigerator and resist condensation.'),
        ('Kombucha Bottle Labels', 'kombucha-bottle-labels', 'Creative labels for kombucha bottles and fermentation vessels.', 'Kombucha labels designed to handle cold fermentation storage.'),
        ('Honey Jar Labels', 'honey-jar-labels', 'Rustic labels for honey jars and bee products.', 'Honey labels available in kraft and natural styles for artisanal products.'),
        ('Coffee Bag Labels', 'coffee-bag-labels', 'Heat-resistant labels for coffee bags and tea packaging.', 'Our coffee bag labels withstand hot surfaces and maintain adhesion.'),
        ('Beverage Bottle Labels', 'beverage-bottle-labels', 'Premium labels for juice, soda, and specialty drinks.', 'Beverage bottle labels designed for cold storage and condensation.'),
    ],
    'pharma-labels': [
        ('Prescription Bottle Labels', 'prescription-bottle-labels', 'High-precision labels for prescription medication bottles.', 'Pharmaceutical labels meeting USP compliance standards for accuracy.'),
        ('Supplement Bottle Labels', 'supplement-bottle-labels', 'FDA-compliant labels for vitamins and dietary supplements.', 'Supplement labels with space for all required nutritional information.'),
        ('Medical Device Labels', 'medical-device-labels', 'Durable labels for medical devices and equipment.', 'Medical device labels engineered for sterilization and chemical resistance.'),
        ('Lab Specimen Labels', 'lab-specimen-labels', 'Cryogenic labels for laboratory specimens and samples.', 'Lab labels designed to withstand extreme temperatures and chemicals.'),
        ('OTC Drug Labels', 'otc-drug-labels', 'Compliant over-the-counter medication packaging labels.', 'OTC labels meeting all FDA labeling requirements for consumer drugs.'),
    ],
    'cannabis-labels': [
        ('Cannabis Tincture Labels', 'cannabis-tincture-labels', 'Child-resistant packaging labels for tinctures and oils.', 'Cannabis tincture labels meeting state compliance requirements.'),
        ('Edibles Packaging Labels', 'edibles-packaging-labels', 'FDA-compliant labels for cannabis edibles and gummies.', 'Edibles labels with required dosing and ingredient information space.'),
        ('Marijuana Jar Labels', 'marijuana-jar-labels', 'Child-resistant jar labels for flower and concentrates.', 'Cannabis jar labels designed for pop-top and child-resistant containers.'),
        ('Vape Cartridge Labels', 'vape-cartridge-labels', 'Compact labels for vape cartridges and pre-filled pens.', 'Vape cartridge labels sized perfectly for standard 510-thread carts.'),
        ('CBD Topical Labels', 'cbd-topical-labels', 'Labels for CBD creams, lotions, and topical products.', 'CBD topical labels with space for ingredient lists and usage instructions.'),
    ],
    'amazon-labels': [
        ('FNSKU Labels', 'fnsku-labels', 'Official FNSKU barcode labels for Amazon FBA products.', 'Amazon-compliant FNSKU labels with scannable barcodes and product info.'),
        ('Shipping Box Labels', 'shipping-box-labels', 'Durable shipping labels for Amazon cartons and pallets.', 'Shipping labels designed to withstand warehouse handling and transportation.'),
        ('Product Insert Labels', 'product-insert-labels', 'Custom product inserts and thank you cards for Amazon orders.', 'Product insert labels with your brand logo and promotional content.'),
        ('Sustainability Labels', 'sustainability-labels', 'Eco-friendly packaging labels for sustainable Amazon products.', 'Sustainability labels showing your commitment to environmental responsibility.'),
        ('Prime Badge Labels', 'prime-badge-labels', 'Prime-eligible product labels and badges.', 'Premium labels designed to meet Amazon Prime packaging requirements.'),
    ],
    
    # Shape categories
    'die-cut-stickers': [
        ('Custom Logo Stickers', 'custom-logo-stickers', 'Die-cut stickers cut precisely to your logo shape. Perfect for branding.', 'Premium die-cut logo stickers for brand promotion and product labeling.'),
        ('Product Label Stickers', 'product-label-stickers', 'Custom die-cut product labels for any shape or design.', 'Die-cut product labels that make your items stand out on shelves.'),
        ('Business Card Stickers', 'business-card-stickers', 'Business card shaped die-cut stickers for networking and promotion.', 'Die-cut business card stickers are memorable takeaways at events.'),
        ('Brand Promotion Stickers', 'brand-promotion-stickers', 'Eye-catching die-cut stickers for marketing campaigns.', 'Premium die-cut promotion stickers for events, giveaways, and campaigns.'),
        ('Laptop Decal Stickers', 'laptop-decal-stickers', 'Die-cut laptop decals with durable vinyl material.', 'Long-lasting laptop decal stickers that wont damage your device.'),
    ],
    'kiss-cut-stickers': [
        ('Sticker Sheet Sets', 'sticker-sheet-sets', 'Custom kiss-cut stickers on sheets. Perfect for organized collections.', 'Our kiss-cut sticker sheets keep your designs organized and easy to distribute.'),
        ('Brand Sticker Sheets', 'brand-sticker-sheets', 'Multiple brand elements on a single sheet for giveaways.', 'Brand sticker sheets with logos, taglines, and contact info.'),
        ('Event Sticker Packs', 'event-sticker-packs', 'Kiss-cut sticker packs for conferences and events.', 'Event sticker packs featuring multiple designs for attendees.'),
        ('Logo Sticker Sheets', 'logo-sticker-sheets', 'Various logo sizes on kiss-cut sheets for versatile use.', 'Kiss-cut logo sheets with your brand in multiple sizes.'),
        ('Promotional Sticker Books', 'promotional-sticker-books', 'Custom sticker books with kiss-cut sheets bound together.', 'Sticker books are perfect for retail, gifts, and promotional packs.'),
    ],
    'circle-stickers': [
        ('Round Price Stickers', 'round-price-stickers', 'Circular stickers perfect for price tags and sale labels.', 'Round price stickers with space for prices, discounts, and offers.'),
        ('Seal Stickers', 'seal-stickers', 'Official-looking round seal stickers for authenticity.', 'Seal stickers add a professional touch to documents and packaging.'),
        ('Logo Circle Stickers', 'logo-circle-stickers', 'Your logo in a classic circular format.', 'Circle logo stickers work great for packaging and branding.'),
        ('Dot Stickers', 'dot-stickers', 'Small circular dot stickers for organization and planning.', 'Colorful dot stickers for bullet journals, planning, and organization.'),
        ('Round Thank You Stickers', 'round-thank-you-stickers', 'Appreciation stickers in a classic round shape.', 'Thank you stickers for gift bags, packaging, and cards.'),
    ],
    'rectangle-stickers': [
        ('Address Labels', 'address-labels', 'Clean rectangular address labels for mailing and shipping.', 'Professional address labels that make your mailings look polished.'),
        ('Product Tag Stickers', 'product-tag-stickers', 'Rectangle stickers perfect for product information tags.', 'Product tag stickers with space for details, ingredients, or barcodes.'),
        ('Barcode Stickers', 'barcode-stickers', 'Custom rectangular barcode labels for inventory management.', 'High-quality barcode stickers that scan reliably every time.'),
        ('Warning Label Stickers', 'warning-label-stickers', 'Rectangular warning and caution labels for products.', 'Safety warning labels in standard rectangular format.'),
        ('Rectangle Logo Stickers', 'rectangle-logo-stickers', 'Your logo on clean rectangular stickers.', 'Rectangle logo stickers are perfect for shipping and packaging.'),
    ],
    'square-stickers': [
        ('Social Media Stickers', 'social-media-stickers', 'Square stickers sized perfectly for social media promotion.', 'Instagram and social media-ready square stickers for online promotion.'),
        ('QR Code Stickers', 'qr-code-stickers', 'Square QR code stickers for easy scanning.', 'QR code stickers that link to your website, menu, or portfolio.'),
        ('Mini Logo Stickers', 'mini-logo-stickers', 'Compact square logo stickers for small applications.', 'Small square stickers are perfect for laptops, phones, and water bottles.'),
        ('Sale Tag Stickers', 'sale-tag-stickers', 'Square sale tags and promotional stickers.', 'Bold square sale stickers for retail displays and windows.'),
        ('Square Stickers Pack', 'square-stickers-pack', 'Versatile square stickers for any occasion.', 'Square stickers work great for packaging, promotion, and giveaways.'),
    ],
    'custom-shape-stickers': [
        ('Custom Logo Shape Stickers', 'custom-logo-shape-stickers', 'Any shape you can imagine, cut precisely to your design.', 'Upload your design and we will cut it to any custom shape.'),
        ('Character Shape Stickers', 'character-shape-stickers', 'Custom character and mascot shaped stickers.', 'Bring your characters to life with custom die-cut shape stickers.'),
        ('Badge Shape Stickers', 'badge-shape-stickers', 'Custom badge and emblem shaped stickers.', 'Badge-shaped stickers for awards, achievements, and recognition.'),
        ('Fruit Shape Stickers', 'fruit-shape-stickers', 'Custom fruit and vegetable shaped stickers.', 'Fun fruit-shaped stickers for food brands and packaging.'),
        ('Badge Ribbon Stickers', 'badge-ribbon-stickers', 'Custom ribbon and badge combination stickers.', 'Award ribbon shaped stickers for recognition and celebrations.'),
    ],
}

# Create 5 products for each category
now = datetime.now().isoformat()
created_count = 0

for cat_id, cat_slug, cat_name, group_name in categories:
    if cat_slug in products_by_category_type:
        products = products_by_category_type[cat_slug]
        for i, (prod_name, prod_slug, hero_sub, description) in enumerate(products):
            # Check if product already exists
            c.execute("SELECT id FROM products WHERE slug = ?", (prod_slug,))
            if c.fetchone():
                continue
            
            # Create product
            c.execute("""
                INSERT INTO products (
                    category_id, name, slug, type, hero_title, description, features, 
                    steps_title, steps, is_active, 
                    sort_order, created_at, updated_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            """, (
                cat_id,
                prod_name,
                prod_slug,
                'standard',
                f'Custom {prod_name}',
                description,
                json.dumps([
                    'Premium quality materials',
                    'Customizable design',
                    'Fast production',
                    'Bulk discounts available',
                    'Free shipping options'
                ]),
                'How to Order',
                json.dumps([
                    {'step': '1', 'title': 'Upload Design', 'description': 'Upload your artwork or logo'},
                    {'step': '2', 'title': 'Select Options', 'description': 'Choose size, material, and quantity'},
                    {'step': '3', 'title': 'Review & Approve', 'description': 'We will send a proof for your approval'},
                    {'step': '4', 'title': 'Production & Shipping', 'description': 'Fast production and delivery'}
                ]),
                1,  # is_active
                i + 1,
                now,
                now
            ))
            created_count += 1
            print(f"Created: {prod_name} -> {cat_name}")
    else:
        print(f"No products template for: {cat_slug}")

conn.commit()
print(f"\nCreated {created_count} new products!")

# Verify results
c.execute("SELECT COUNT(*) FROM products")
print(f"Total products in database: {c.fetchone()[0]}")

print("\n=== Products per category ===")
c.execute("""
    SELECT c.name, COUNT(p.id) as count 
    FROM categories c 
    LEFT JOIN products p ON c.id = p.category_id AND p.is_active = 1
    WHERE c.slug IN (
        'vinyl-stickers', 'pet-labels', 'pp-labels', 'kraft-labels', 'foil-labels', 'transparent-labels',
        'brewery-labels', 'cosmetic-labels', 'food-beverage-labels', 'pharma-labels', 'cannabis-labels', 'amazon-labels',
        'die-cut-stickers', 'kiss-cut-stickers', 'circle-stickers', 'rectangle-stickers', 'square-stickers', 'custom-shape-stickers'
    )
    GROUP BY c.id, c.name 
    ORDER BY count DESC
""")
for row in c.fetchall():
    status = "OK" if row[1] >= 5 else "LOW"
    print(f"  [{status}] {row[0]}: {row[1]} products")

conn.close()
