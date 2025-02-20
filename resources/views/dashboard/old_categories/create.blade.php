<x-dashboard.layout>

    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            Category list
        </x-slot:title>
    </x-dashboard.page-title>

    <div class="flex gap-6 item-start">

        <div class="w-2/5 rounded-lg">

            <div class="">
                <form action="{{ route('dashboard.categories.store') }}" method="POST">
                    @csrf

                    <x-form.field class="bg-gray-50">
                        <x-form.label>
                            Category Name
                        </x-form.label>
                        <x-form.input type="text" name="name" id="name" class="mt-2 form-control !w-full" required />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label>
                            Category Slug
                        </x-form.label>
                        <x-form.input type="text" name="slug" id="slug" class="mt-2 form-control !w-full" required />
                    </x-form.field>

                    <x-form.field>
                        <x-form.label>
                            Description
                        </x-form.label>
                        <x-form.textarea type="textarea" name="description" rows="6" id="description" class="mt-2 form-control !w-full resize-none" />
                    </x-form.field>

                    <x-form.field class="!mt-0">
                        <x-form.button class="mt-6">
                            Add Category
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
