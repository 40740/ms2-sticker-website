<footer class="footer mt-auto">
    <div class="max-w-[1200px] mx-auto px-6 pt-16 pb-8">
        <div class="grid grid-cols-1 mobile:grid-cols-2 tablet:grid-cols-4 gap-10">
            
            <div>
                <h4 class="footer-title text-xl mb-5"><?php echo e(\App\Models\Setting::get('site_name', 'MeisaiPrinting')); ?></h4>
                <p class="text-footer-text text-sm leading-relaxed mb-6">
                    <?php echo e(\App\Models\Setting::get('footer_about', 'MeisaiPrinting is a professional custom sticker and label printing manufacturer with over 24 years of experience. We provide high-quality adhesive solutions for businesses worldwide.')); ?>

                </p>
                
                <div class="flex items-center gap-4">
                    <a href="<?php echo e(\App\Models\Setting::get('social_facebook', '#')); ?>" class="text-footer-text hover:text-brand transition-all duration-300" aria-label="Facebook">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="<?php echo e(\App\Models\Setting::get('social_instagram', '#')); ?>" class="text-footer-text hover:text-brand transition-all duration-300" aria-label="Instagram">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                    <a href="<?php echo e(\App\Models\Setting::get('social_youtube', '#')); ?>" class="text-footer-text hover:text-brand transition-all duration-300" aria-label="YouTube">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="<?php echo e(\App\Models\Setting::get('social_tiktok', '#')); ?>" class="text-footer-text hover:text-brand transition-all duration-300" aria-label="TikTok">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                    </a>
                </div>
            </div>

            
            <div>
                <h4 class="footer-title text-xl mb-5">Contact Us</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:<?php echo e(\App\Models\Setting::get('contact_email', 'info@meisaiprinting.com')); ?>" class="text-footer-text hover:text-brand transition-all duration-300">
                            <?php echo e(\App\Models\Setting::get('contact_email', 'info@meisaiprinting.com')); ?>

                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:<?php echo e(\App\Models\Setting::get('contact_phone', '+1-800-123-4567')); ?>" class="text-footer-text hover:text-brand transition-all duration-300">
                            <?php echo e(\App\Models\Setting::get('contact_phone', '+1-800-123-4567')); ?>

                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-brand shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-footer-text">
                            <?php echo e(\App\Models\Setting::get('contact_address', '123 Sticker Lane, Printing City, CA 90001, USA')); ?>

                        </span>
                    </li>
                </ul>
            </div>

            
            <div>
                <h4 class="footer-title text-xl mb-5">Quick Links</h4>
                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="/materials" class="text-footer-text hover:text-brand transition-all duration-300 flex items-center gap-2">
                            <svg class="w-3 h-3 text-brand shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Materials
                        </a>
                    </li>
                    <li>
                        <a href="/industries" class="text-footer-text hover:text-brand transition-all duration-300 flex items-center gap-2">
                            <svg class="w-3 h-3 text-brand shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Industries
                        </a>
                    </li>
                    <li>
                        <a href="/shapes" class="text-footer-text hover:text-brand transition-all duration-300 flex items-center gap-2">
                            <svg class="w-3 h-3 text-brand shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Shapes
                        </a>
                    </li>
                    <li>
                        <a href="/pages/custom-stickers" class="text-footer-text hover:text-brand transition-all duration-300 flex items-center gap-2">
                            <svg class="w-3 h-3 text-brand shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Custom Stickers
                        </a>
                    </li>
                    <li>
                        <a href="/pages/blank-labels" class="text-footer-text hover:text-brand transition-all duration-300 flex items-center gap-2">
                            <svg class="w-3 h-3 text-brand shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Blank Labels
                        </a>
                    </li>
                    <li>
                        <a href="/pages/free-samples" class="text-footer-text hover:text-brand transition-all duration-300 flex items-center gap-2">
                            <svg class="w-3 h-3 text-brand shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Free Samples
                        </a>
                    </li>
                </ul>
            </div>

            
            <div>
                <h4 class="footer-title text-xl mb-5">Newsletter</h4>
                <p class="text-footer-text text-sm mb-5 leading-relaxed">
                    Subscribe to our newsletter and get the latest updates on new products and special offers.
                </p>
                <div class="space-y-3"
                      x-data="{
                          email: '',
                          submitted: false,
                          loading: false,
                          errorMsg: '',
                          async submit() {
                              if (this.loading) return;
                              this.loading = true;
                              this.errorMsg = '';
                              try {
                                  const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');
                                  const res = await fetch('/newsletter/subscribe', {
                                      method: 'POST',
                                      headers: {
                                          'X-CSRF-TOKEN': token,
                                          'Accept': 'application/json',
                                          'Content-Type': 'application/json',
                                      },
                                      body: JSON.stringify({ email: this.email }),
                                  });
                                  const data = await res.json();
                                  if (res.ok) {
                                      this.submitted = true;
                                      this.email = '';
                                      setTimeout(() => { this.submitted = false; }, 5000);
                                  } else {
                                      if (data.errors && data.errors.email) {
                                          this.errorMsg = data.errors.email[0];
                                      } else {
                                          this.errorMsg = data.message || 'Subscription failed. Please try again.';
                                      }
                                  }
                              } catch (e) {
                                  this.errorMsg = 'Network error. Please try again.';
                              } finally {
                                  this.loading = false;
                              }
                          }
                      }">
                    <form @submit.prevent="submit()">
                        <div class="flex">
                            <input type="email"
                                   name="email"
                                   x-model="email"
                                   placeholder="Your email address"
                                   required
                                   class="flex-1 px-4 py-3 bg-white/10 border border-footer-line text-white placeholder:text-footer-text/60 rounded-none focus:outline-none focus:border-brand transition-all duration-300 text-sm">
                            <button type="submit" class="btn-submit px-6 py-3" :disabled="loading">
                                <span x-show="!loading">Subscribe</span>
                                <span x-show="loading" class="flex items-center gap-1">
                                    <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Sending...
                                </span>
                            </button>
                        </div>
                    </form>
                    <p x-show="submitted" x-transition class="text-green-400 text-sm">Thank you for subscribing!</p>
                    <p x-show="errorMsg" x-transition class="text-red-400 text-sm" x-text="errorMsg"></p>
                </div>
            </div>
        </div>

        
        <hr class="footer-line my-10">

        
        <div class="flex flex-col mobile:flex-row items-center justify-between gap-4 text-sm text-footer-text">
            <p>&copy; <?php echo e(date('Y')); ?> <?php echo e(\App\Models\Setting::get('site_name', 'MeisaiPrinting')); ?>. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="/sitemap.xml" class="hover:text-brand transition-all duration-300">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/footer.blade.php ENDPATH**/ ?>