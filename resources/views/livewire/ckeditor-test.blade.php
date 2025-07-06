<div>
    {{-- Be like water. --}}

    <div class="col-span-1 md:col-span-2">
        <label class="block mb-1 font-medium">Description</label>

        <div wire:ignore x-data x-init="let easyMDE = new EasyMDE({
            element: $refs.markdown,
            forceSync: true,
        });
        easyMDE.codemirror.on('change', () => {
            @this.set('description', easyMDE.value());
        });">
            <textarea x-ref="markdown" class="w-full border rounded p-3">{!! $description !!}</textarea>
        </div>

        @error('description')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>


</div>
