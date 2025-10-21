@props(['disabled' => false, 'name', 'model' => null])

<label class="inline-flex items-center cursor-pointer">
  <input type="hidden" name="{{ $name }}" value="0">

    <input @disabled($disabled) type="checkbox" class="sr-only peer" name="{{ $name }}"
        value="1" 
        @if($model)
            x-model="{{ $model }}"
        @endif>
    <div
        class="relative w-11 h-6 bg-gray-200 rounded-full dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-panache dark:peer-checked:bg-panache">
    </div>
</label>
