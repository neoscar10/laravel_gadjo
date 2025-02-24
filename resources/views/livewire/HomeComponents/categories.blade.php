<div class="bg-orange-200 py-20">
    <div class="max-w-xl mx-auto">
      <div class="text-center ">
        <div class="relative flex flex-col items-center">
          <h1 class="text-5xl font-bold "> Browse <span class="text-orange-500"> Categories
            </span> </h1>
          <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
            <div class="flex-1 h-2 bg-orange-200">
            </div>
            <div class="flex-1 h-2 bg-orange-400">
            </div>
            <div class="flex-1 h-2 bg-orange-600">
            </div>
          </div>
        </div>
        <p class="mb-12 text-base text-center text-gray-500">
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Delectus magni eius eaque?
          Pariatur
          numquam, odio quod nobis ipsum ex cupiditate?
        </p>
      </div>
    </div>
  
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
      <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
  
        @foreach ($categories as $category)
        <a wire:key="{{$category->id}}" class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition " href="/products?selected_categories[0]={{$category->id}}" >
          <div class="p-4 md:p-5">
            <div class="flex justify-between items-center">
              <div class="flex items-center">
                <img class="h-[2.375rem] w-[2.375rem] rounded-full" src="{{url('storage', $category->image)}}" alt="{{$category->name}}">
                <div class="ms-3">
                  <h3 class="group-hover:text-orange-600 font-semibold text-gray-">
                    {{$category->name}}
                  </h3>
                </div>
              </div>
              <div class="ps-3">
                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6" />
                </svg>
              </div>
            </div>
          </div>
        </a>
        @endforeach
  
      </div>
    </div>
  
  </div>