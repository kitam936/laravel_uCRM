<script setup>

import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,Link} from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue'
import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia';


defineProps({
    customers:Object,
})

const search = ref('')
// ref の値を取得するには .valueが必要
const searchCustomers = () => {
Inertia.get(route('customers.index', { search: search.value }))
}


</script>

<template>
    <Head title="顧客一覧" />

    <AuthenticatedLayout>
        <template #header>
            <!-- <div v-if="$page.props.flash.message && $page.props.flash.status == 'alert'" class="bg-red-400">
                {{ $page.props.flash.message }}
            </div>
            <div v-if="$page.props.flash.message && $page.props.flash.status == 'info'" class="bg-blue-400">
                {{ $page.props.flash.message }}
            </div> -->
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客一覧</h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <FlashMessage/>
                    <div class="p-6 text-gray-900">
                        <div class="flex ml-24 mb-8">
                        <div class="h-8 mr-12">
                            <input class="h-8 rounded" type="text" name="search" v-model="search">
                            <button class="bg-blue-300 text-white px-2 h-8 rounded "
                            @click="searchCustomers">検索</button>
                        </div>
                            <Link as="button" :href="route('customers.create')" class="w-32 h-8 bg-indigo-500 text-sm text-white ml-0 hover:bg-indigo-600 rounded">顧客登録</Link>
                        </div>

                        <div class=" mx-auto w-2/3 sm:px-4 lg:px-4 border ">
                        <table class="bg-white table-auto w-full text-center whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">id</th>
                                    <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">name</th>
                                    <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">kana</th>
                                    <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Tel</th>

                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="customer in customers.data" :key="customer.id">
                                    <td class="border-b-2 boder-gray-200">
                                        <Link class="text-indigo-500" :href="route('customers.show',{customer:customer.id})">{{ customer.id }} </Link>
                                    </td>
                                    <td class="border-b-2 boder-gray-200">{{ customer.name }} </td>
                                    <td class="border-b-2 boder-gray-200">{{ customer.kana }} </td>
                                    <td class="border-b-2 boder-gray-200">{{ customer.tel }} </td>

                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <Pagination ation class="ml-48 mt-6" :links="customers.links"></Pagination>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
