{{-- FAQ Form Partial --}}
{{-- Expects: $faq (optional, for edit), $categories, $products --}}

<div class="space-y-6">
    {{-- Basic Info --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">FAQ详情</h3>
        <div class="space-y-6">
            {{-- Question --}}
            <div>
                <label for="question" class="block text-sm font-medium text-gray-700 mb-1">问题 <span class="text-red-500">*</span></label>
                <input type="text" id="question" name="question" value="{{ old('question', $faq->question ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                       required>
                @error('question')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Answer --}}
            <div>
                <label for="answer" class="block text-sm font-medium text-gray-700 mb-1">回答 <span class="text-red-500">*</span></label>
                <textarea id="answer" name="answer" rows="5"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                          required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Product --}}
                <div>
                    <label for="product_id" class="block text-sm font-medium text-gray-700 mb-1">产品</label>
                    <select id="product_id" name="product_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                        <option value="">-- 无 --</option>
                        @foreach($products as $prod)
                            <option value="{{ $prod->id }}" {{ old('product_id', $faq->product_id ?? '') == $prod->id ? 'selected' : '' }}>{{ $prod->name }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">分类</label>
                    <select id="category_id" name="category_id"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                        <option value="">-- 无 --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $faq->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Sort Order --}}
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">排序</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                </div>

                {{-- Is Active --}}
                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', isset($faq) ? $faq->is_active : true) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#FF008A]/30 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF008A]"></div>
                        <span class="ms-3 text-sm font-medium text-gray-700">启用</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-4">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#FF008A] text-white rounded-lg text-sm font-semibold hover:bg-[#FF33A1] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
            {{ isset($faq) ? '更新FAQ' : '创建FAQ' }}
        </button>
        <a href="{{ route('admin.faqs.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">取消</a>
    </div>
</div>
