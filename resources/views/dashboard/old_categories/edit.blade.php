<x-dashboard.layout>

    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            Edit Category: {{ $category->name }}
        </x-slot:title>
    </x-dashboard.page-title>

    <div class="flex gap-6 item-start">

        <div class="w-2/5 rounded-lg">

            <div class="">
                <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <x-form.field class="bg-gray-50">
                        <x-form.label>
                            Category Name
                        </x-form.label>
                        <x-form.input type="text" name="name" id="name" :value="old('name', $category->name)" class="mt-2 form-control !w-full" required />
                        <x-form.error name="name"/>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label>
                            Category Slug
                        </x-form.label>
                        <x-form.input type="text" name="slug" id="slug" :value="old('slug', $category->slug)" class="mt-2 form-control !w-full" required />
                        <x-form.error name="slug"/>
                    </x-form.field>

                    <x-form.field>
                        <x-form.label>
                            Description
                        </x-form.label>
                        <x-form.textarea type="textarea" name="description" id="description" rows="6" class="mt-2 form-control !w-full resize-none">
                            {{ old('description', $category->description) }}
                        </x-form.textarea>
                        <x-form.error name="description"/>
                    </x-form.field>

                    <x-form.field class="!mt-0">
                        <x-form.button class="mt-6">
                            Update
                        </x-form.button>
                    </x-form.field>
                </form>
            </div>

        </div>

        <div class="w-3/5 bg-white p-6 rounded-lg shadow-md">
            @if ($categories->count() > 0)
                <x-dashboard.taxonomy-list :items="$categories" />
            @else
                <p>
                    There are no categories yet.
                </p>
            @endif
        </div>
    </div>

</x-dashboard.layout>
