<script setup>
import FlashMessage from '@/Components/FlashMessage.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,Link} from '@inertiajs/vue3';
import { onMounted,reactive ,ref, computed} from 'vue';
import Pagination from '@/Components/Pagination.vue'
import dayjs from 'dayjs'
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    orders:Object,
    customers:Object,
})

onMounted(() => {
    console.log(props.orders.data)
    console.log(props.customers.data)
})

const search = ref('')
// ref の値を取得するには .valueが必要
const searchPurchases = () => {
Inertia.get(route('purchases.index', { search: search.value }))
}

</script>

<template>
    <Head title="購買履歴" />

<AuthenticatedLayout>
    <template #header>
        <!-- <div v-if="$page.props.flash.message && $page.props.flash.status == 'alert'" class="bg-red-400">
            {{ $page.props.flash.message }}
        </div>
        <div v-if="$page.props.flash.message && $page.props.flash.status == 'info'" class="bg-blue-400">
            {{ $page.props.flash.message }}
        </div> -->
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴</h2>
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
                        @click="searchPurchases">検索</button>
                    </div>
                    </div>

                    <div class=" mx-auto w-2/3 sm:px-4 lg:px-4 border ">
                    <table class="bg-white table-auto w-full text-center whitespace-no-wrap">
                        <thead>
                            <tr>
                                <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">id</th>
                                <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">name</th>
                                <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Total</th>
                                <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">status</th>
                                <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="order in props.orders.data" :key="order.id">
                                <td class="border-b-2 boder-gray-200">
                                    <Link class="text-indigo-500" :href="route('purchases.show',{purchase:order.id})">{{ order.id }} </Link>
                                </td>
                                <td class="border-b-2 boder-gray-200">{{ order.customer_name }} </td>
                                <td class="border-b-2 boder-gray-200">{{ order.total}} </td>
                                <td class="border-b-2 boder-gray-200">{{ order.status }} </td>
                                <td class="border-b-2 boder-gray-200">{{ dayjs(order.created_at).format('YYYY-MM-DD HH:mm:ss') }}</td>
                            </tr>
                        </tbody>
                    </table>

                    </div>
                    <Pagination ation class="ml-48 mt-6" :links="props.orders.links"></Pagination>
                </div>

            </div>

        </div>

    </div>
</AuthenticatedLayout>

</template>
