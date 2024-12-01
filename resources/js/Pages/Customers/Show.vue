<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,Link} from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    customer : Object
})

// const form = reactive({


const deleteCustomer = id => {
    Inertia.delete(route('customers.destroy',{customer:id}),{
        onBefore:() => confirm('本当に削除しますか？')
    })
}



</script>

<template>
    <Head title="顧客詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">

                            <div class="container px-5 py-8 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex flex-wrap -m-2">
                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="name" class="leading-7 text-sm text-gray-600">顧客名</label>
                                        <div type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ customer.name }}</div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="kana" class="leading-7 text-sm text-gray-600">カナ</label>
                                        <div type="text" id="kana" name="kana" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ customer.kana }}</div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="tel" class="leading-7 text-sm text-gray-600">電話番号</label>
                                        <div type="tel" id="tel" name="tel" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ customer.tel }}</div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="email" class="leading-7 text-sm text-gray-600">email</label>
                                        <div type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ customer.email }}</div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="postcode" class="leading-7 text-sm text-gray-600">郵便番号</label>
                                        <div type="number" id="postcode" name="postcode" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ customer.postcode }}</div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="address" class="leading-7 text-sm text-gray-600">住所</label>
                                        <div type="text" id="address" name="address" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ customer.address }}</div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="birthday" class="leading-7 text-sm text-gray-600">誕生日</label>
                                        <div type="date" id="birthday" name="birthday" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ customer.birthday }}</div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label class="mr-4 leading-7 text-sm text-gray-600">性別</label>
                                        <div id="gender" name="gender" class="leading-7 text-sm text-gray-600 bg-gray-100 bg-opacity-50 rounded border border-gray-300">
                                            <span v-if="customer.gender === 0 ">男性</span>
                                            <span v-if="customer.gender === 1 ">女性</span>
                                            <span v-if="customer.gender === 2 ">回答なし</span>
                                        </div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="memo" class="leading-7 text-sm text-gray-600">詳細</label>
                                        <div id="memo" name="memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">{{ customer.memo }}</div>

                                    </div>
                                    </div>

                                    <div class="p-2 w-full">
                                        <Link as="button" :href="route('customers.edit',{customer:customer.id})" class="w-32 flex mx-auto text-white bg-indigo-500 border-0 py-2 px-2 focus:outline-none hover:bg-indigo-600 rounded text-lg">編集</Link>
                                    </div>
                                    <div class="p-2 w-full">
                                        <button class="w-32 flex mx-auto text-white bg-red-500 border-0 py-2 px-2 focus:outline-none hover:bg-red-600 rounded text-lg" @click="deleteCustomer(customer.id)" >削除する</button>
                                    </div>

                                </div>
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
