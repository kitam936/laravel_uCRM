<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,Link} from '@inertiajs/vue3';
import { onMounted,reactive ,ref, computed} from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/vue3'
import dayjs from 'dayjs'

const props =  defineProps({
    items: Array,
    order :Array,
    // customers: Array,
    // errors : Object,
})

onMounted(()=>{
    console.log(props.items[0])
    console.log(props.order[0].customer_name)

})

</script>

<template>
    <Head title="購買履歴詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購買履歴詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storePuchase">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex-wrap -m-2">
                                    <div class="flex">
                                    <div class="p-2 w-full">
                                    <div class="relative ">
                                        <label for="pur_id" class="mr-6 leading-7 text-sm text-gray-600">ID</label>
                                        <div type="text" id="pur_id" name="pur_id" class="w-40 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ props.order[0].id }}
                                        </div>
                                    </div>
                                    </div>
                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="date" class="mr-4 leading-7 text-sm text-gray-600">Date</label>
                                        <div type="date" id="date" name="date" class="w-40 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ dayjs(props.order[0].created_at).format('YYYY-MM-DD') }}
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="flex">
                                    <div class="p-2 w-full">
                                    <div class="relative ">
                                        <label for="customer_id" class="mr-6 leading-7 text-sm text-gray-600">Customer_ID</label>
                                        <div type="text" id="customer_id" name="customer_id" class="w-40 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ props.order[0].customer_id }}
                                        </div>
                                    </div>
                                    </div>
                                    <div class="p-2 w-full">
                                    <div class="relative ">
                                        <label for="customer" class="mr-6 leading-7 text-sm text-gray-600">Name</label>
                                        <div type="text" id="customer" name="customer" class="w-40 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ props.order[0].customer_name }}
                                        </div>
                                    </div>
                                    </div>
                                </div>


                                    <div class=" mt-8 p-2 mx-auto w-full sm:px-4 lg:px-0 rounded border ">

                                    <table class="bg-white table-auto w-full text-center whitespace-no-wrap">
                                        <thead>
                                            <tr>
                                                <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">id</th>
                                                <th class="w-1/13 md:1/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">品名</th>
                                                <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">単価</th>
                                                <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">数量</th>
                                                <th class="w-3/13 md:3/13 md:px-4 py-1 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">小計</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="item in props.items" :key="item.id">
                                                <td class="border-b-2 boder-gray-200">{{ item.item_id }} </td>
                                                <td class="border-b-2 boder-gray-200">{{ item.item_name }} </td>
                                                <td class="border-b-2 boder-gray-200">{{ item.item_price }} </td>
                                                <td class="border-b-2 boder-gray-200">{{ item.quantity }} </td>
                                                <td class="border-b-2 boder-gray-200">{{ item.subtotal }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    </div>
                                    <div class="p-2 w-full">
                                    <div class="">
                                        <label for="total" class="leading-7 text-sm text-gray-600">Total</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ props.order[0].total }}円</div>
                                    </div>

                                    <div class="">
                                        <label for="status" class="leading-7 text-sm text-gray-600">Status</label>
                                        <div v-if="props.order[0].status == true" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            未キャンセル
                                        </div>
                                        <div v-if="props.order[0].status == false" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            キャンセル済
                                        </div>
                                    </div>

                                    <div v-if="props.order[0].status == false" class="">
                                        <label for="cancel_date" class="leading-7 text-sm text-gray-600">キャンセル日</label>
                                        <div v-if="props.order[0].status == false" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            {{ dayjs(props.order[0].updated_at).format('YYYY-MM-DD') }}
                                        </div>
                                    </div>

                                    </div>
                                    <div v-if="props.order[0].status==true" class="p-2 w-full">
                                        <Link as="button" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg" :href="route('purchases.edit',{purchase:props.order[0].id})">編集 </Link>

                                    </div>

                                </div>
                                </div>
                            </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
