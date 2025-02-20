<x-dashboard.layout>

    <x-dashboard.welcome />

    <x-dashboard.page-title>
        <x-slot:title>
            Edit Comment
        </x-slot:title>
    </x-dashboard.page-title>

    <div class="flex gap-6 item-start">

        <div class="rounded-lg">

            <div class="">
                <form action="{{ route('dashboard.comments.update', $comment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-12 gap-x-4">
                        <div class="col-span-5">
                            <x-form.field>
                                <x-form.label>
                                    Description
                                </x-form.label>
                                <x-form.textarea type="textarea" name="content" id="content" rows="6" class="mt-2 form-control !w-full resize-none">
                                    {{ old('content', $comment->content) }}
                                </x-form.textarea>
                                <x-form.error name="content"/>
                            </x-form.field>
                        </div>

                        <div class="col-span-4">
                            <x-form.field class="bg-gray-50">
                                <x-form.label>
                                    Author Name
                                </x-form.label>
                                <x-form.input type="text" name="name" id="name" :value="old('name', $comment->user->name)" class="mt-2 form-control !w-full" required />
                                <x-form.error name="name"/>
                            </x-form.field>

                            <x-form.field>
                                <x-form.label>
                                    Author Email
                                </x-form.label>
                                <x-form.input type="email" name="email" id="email" :value="old('email', $comment->user->email)" class="mt-2 form-control !w-full" required />
                                <x-form.error name="email"/>
                            </x-form.field>
                        </div>
                    </div>

                    <x-form.field class="!mt-0">
                        <x-form.button class="mt-3">
                            Update
                        </x-form.button>
                    </x-form.field>
                </form>
            </div>

        </div>
    </div>


</x-dashboard.layout>
