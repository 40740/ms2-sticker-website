{{-- Certificate Form Partial --}}
{{-- Expects: $certificate (optional, for edit) --}}

<div class="space-y-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">证书详情</h3>
        <div class="space-y-6">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名称 <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $certificate->name ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">证书图片 <span class="text-red-500">*</span></label>
                @if(isset($certificate) && $certificate->image)
                    <div class="mb-2">
                        <img src="{{ Storage::disk('uploads')->url($certificate->image) }}" alt="{{ $certificate->name }}" class="h-24 w-auto rounded-lg object-cover">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-[#FF008A] hover:file:bg-pink-100"
                       {{ isset($certificate) ? '' : 'required' }}>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Sort Order --}}
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">排序</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $certificate->sort_order ?? 0) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                </div>

                {{-- Is Active --}}
                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', isset($certificate) ? $certificate->is_active : true) ? 'checked' : '' }}
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
            {{ isset($certificate) ? '更新证书' : '创建证书' }}
        </button>
        <a href="{{ route('admin.certificates.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">取消</a>
    </div>
</div>
