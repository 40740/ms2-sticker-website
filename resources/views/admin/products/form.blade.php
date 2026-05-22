{{-- Product Form Partial --}}
{{-- Expects: $product (optional, for edit), $categories --}}

<div class="space-y-6" x-data="{
    slugManuallyEdited: false,
    selectedType: '{{ old('type', $product->type ?? 'sticker') }}',
    features: {{ json_encode(old('features', $product->features ?? [])) }} || [],
    steps: {{ json_encode(old('steps', $product->steps ?? [])) }} || [],
    concerns: {{ json_encode(old('concerns', $product->concerns ?? [])) }} || [],
    testimonials: {{ json_encode(old('testimonials', $product->testimonials ?? [])) }} || [],

    addFeature() {
        this.features.push({ title: '', description: '', image: '' });
    },
    removeFeature(index) {
        this.features.splice(index, 1);
    },
    addStep() {
        this.steps.push({ step: this.steps.length + 1, title: '', description: '' });
    },
    removeStep(index) {
        this.steps.splice(index, 1);
    },
    addConcern() {
        this.concerns.push({ title: '', description: '', image: '' });
    },
    removeConcern(index) {
        this.concerns.splice(index, 1);
    },
    addTestimonial() {
        this.testimonials.push({ name: '', country: '', avatar: '', text: '' });
    },
    removeTestimonial(index) {
        this.testimonials.splice(index, 1);
    }
}">

    {{-- Basic Info --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">基本信息</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名称 <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}"
                       x-on:input="if(!slugManuallyEdited) { $refs.slugInput.value = $event.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') }"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">类型 <span class="text-red-500">*</span></label>
                <select id="type" name="type" x-model="selectedType"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                        required>
                    <option value="sticker">Sticker</option>
                    <option value="label">Label</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">分类 <span class="text-red-500">*</span></label>
                <select id="category_id" name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                        required>
                    <option value="">请选择分类</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                                x-show="selectedType === '{{ $cat->type }}'"
                                {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">URL标识</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug ?? '') }}"
                       x-ref="slugInput"
                       x-on:input="slugManuallyEdited = true"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                       placeholder="auto-generated-from-name">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sort Order --}}
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">排序</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $product->sort_order ?? 0) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
            </div>

            {{-- Is Active --}}
            <div class="flex items-center">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', isset($product) ? $product->is_active : true) ? 'checked' : '' }}
                           class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#FF008A]/30 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF008A]"></div>
                    <span class="ms-3 text-sm font-medium text-gray-700">启用</span>
                </label>
            </div>
        </div>

        {{-- Description --}}
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">描述</label>
            <textarea id="description" name="description" rows="4"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    {{-- Images --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">图片</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">产品主图</label>
                @if(isset($product) && $product->image)
                    <div class="mb-2">
                        @php
                            $adminImg = $product->image;
                            if ($adminImg && !str_starts_with($adminImg, '/') && !str_starts_with($adminImg, 'http')) {
                                $adminImg = '/' . ltrim($adminImg, '/');
                            }
                        @endphp
                        <img src="{{ $adminImg }}" alt="Product image" class="h-24 w-auto rounded-lg object-cover"
                             onerror="this.src='/images/product-placeholder.jpg'">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-[#FF008A] hover:file:bg-pink-100">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Hero图片</label>
                @if(isset($product) && $product->hero_image)
                    <div class="mb-2">
                        @php
                            $adminHeroImg = $product->hero_image;
                            if ($adminHeroImg && !str_starts_with($adminHeroImg, '/') && !str_starts_with($adminHeroImg, 'http')) {
                                $adminHeroImg = '/' . ltrim($adminHeroImg, '/');
                            }
                        @endphp
                        <img src="{{ $adminHeroImg }}" alt="Hero image" class="h-24 w-auto rounded-lg object-cover"
                             onerror="this.src='/images/product-placeholder.jpg'">
                    </div>
                @endif
                <input type="file" name="hero_image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-[#FF008A] hover:file:bg-pink-100">
                @error('hero_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Hero Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">Hero区域</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-1">Hero标题</label>
                <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title', $product->hero_title ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
            </div>
            <div>
                <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 mb-1">Hero副标题</label>
                <input type="text" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $product->hero_subtitle ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
            </div>
        </div>
    </div>

    {{-- Features Repeater --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-md font-semibold text-gray-800">产品特点</h3>
            <button type="button" @click="addFeature()"
                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF008A] bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                添加特点
            </button>
        </div>
        <template x-for="(feature, index) in features" :key="index">
            <div class="p-4 mb-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-gray-600">特点 <span x-text="index + 1"></span></span>
                    <button type="button" @click="removeFeature(index)" class="text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">标题</label>
                        <input type="text" :name="'features[' + index + '][title]'" x-model="features[index].title"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">图片URL</label>
                        <input type="text" :name="'features[' + index + '][image]'" x-model="features[index].image"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="block text-xs font-medium text-gray-500 mb-1">描述</label>
                    <textarea :name="'features[' + index + '][description]'" x-model="features[index].description" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"></textarea>
                </div>
            </div>
        </template>
        <div x-show="features.length === 0" class="text-center py-6 text-sm text-gray-400">
            暂未添加特点，点击"添加特点"开始
        </div>
    </div>

    {{-- Steps Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="mb-4">
            <label for="steps_title" class="block text-sm font-medium text-gray-700 mb-1">步骤区标题</label>
            <input type="text" id="steps_title" name="steps_title" value="{{ old('steps_title', $product->steps_title ?? '') }}"
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
        </div>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-md font-semibold text-gray-800">步骤</h3>
            <button type="button" @click="addStep()"
                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF008A] bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                添加步骤
            </button>
        </div>
        <template x-for="(step, index) in steps" :key="index">
            <div class="p-4 mb-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-gray-600">步骤 <span x-text="index + 1"></span></span>
                    <button type="button" @click="removeStep(index)" class="text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">步骤编号</label>
                        <input type="number" :name="'steps[' + index + '][step]'" x-model="steps[index].step"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">标题</label>
                        <input type="text" :name="'steps[' + index + '][title]'" x-model="steps[index].title"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">图标</label>
                        <input type="text" :name="'steps[' + index + '][icon]'" x-model="steps[index].icon"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                               placeholder="图标名称或URL">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="block text-xs font-medium text-gray-500 mb-1">描述</label>
                    <textarea :name="'steps[' + index + '][description]'" x-model="steps[index].description" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"></textarea>
                </div>
            </div>
        </template>
        <div x-show="steps.length === 0" class="text-center py-6 text-sm text-gray-400">
            暂未添加步骤，点击"添加步骤"开始
        </div>
    </div>

    {{-- Concerns Repeater --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-md font-semibold text-gray-800">关注点</h3>
            <button type="button" @click="addConcern()"
                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF008A] bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                添加关注点
            </button>
        </div>
        <template x-for="(concern, index) in concerns" :key="index">
            <div class="p-4 mb-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-gray-600">关注点 <span x-text="index + 1"></span></span>
                    <button type="button" @click="removeConcern(index)" class="text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">标题</label>
                        <input type="text" :name="'concerns[' + index + '][title]'" x-model="concerns[index].title"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">图片URL</label>
                        <input type="text" :name="'concerns[' + index + '][image]'" x-model="concerns[index].image"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="block text-xs font-medium text-gray-500 mb-1">描述</label>
                    <textarea :name="'concerns[' + index + '][description]'" x-model="concerns[index].description" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"></textarea>
                </div>
            </div>
        </template>
        <div x-show="concerns.length === 0" class="text-center py-6 text-sm text-gray-400">
            暂未添加关注点，点击"添加关注点"开始
        </div>
    </div>

    {{-- Testimonials Repeater --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-md font-semibold text-gray-800">客户评价</h3>
            <button type="button" @click="addTestimonial()"
                    class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF008A] bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                添加评价
            </button>
        </div>
        <template x-for="(testimonial, index) in testimonials" :key="index">
            <div class="p-4 mb-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-gray-600">评价 <span x-text="index + 1"></span></span>
                    <button type="button" @click="removeTestimonial(index)" class="text-red-500 hover:text-red-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">姓名</label>
                        <input type="text" :name="'testimonials[' + index + '][name]'" x-model="testimonials[index].name"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">国家</label>
                        <input type="text" :name="'testimonials[' + index + '][country]'" x-model="testimonials[index].country"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">头像URL</label>
                        <input type="text" :name="'testimonials[' + index + '][avatar]'" x-model="testimonials[index].avatar"
                               class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="block text-xs font-medium text-gray-500 mb-1">评价内容</label>
                    <textarea :name="'testimonials[' + index + '][text]'" x-model="testimonials[index].text" rows="2"
                              class="w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"></textarea>
                </div>
            </div>
        </template>
        <div x-show="testimonials.length === 0" class="text-center py-6 text-sm text-gray-400">
            暂未添加评价，点击"添加评价"开始
        </div>
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-4">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#FF008A] text-white rounded-lg text-sm font-semibold hover:bg-[#FF33A1] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
            {{ isset($product) ? '更新产品' : '创建产品' }}
        </button>
        <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">取消</a>
    </div>
</div>
