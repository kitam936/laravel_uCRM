<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head ,Link} from '@inertiajs/vue3';
import { onMounted,reactive ,ref, computed} from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/vue3'
import {getToday} from '@/common/'
import MicroModal from '@/Components/MicroModal.vue';

const props =  defineProps({
    items: Array,
    customers: Array,
    errors : Object,
})

const itemList = ref([]);

onMounted(()=>{
    form.date = getToday()
    props.items.forEach( item => { // 配列を1つずつ処理
    itemList.value.push({ // 配列に1つずつ追加
    id: item.id,
    name: item.name,
    price: item.price,
    quantity: 0 })
    })
})

const quantity = [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"] // option用


const form = useForm({
    date:null,
    customer_id:null,
    name:null,
    status:true,
    items:[],
})

const totalPrice = computed(()=>{
    let total =0
    itemList.value.forEach(item=>{
        total += item.quantity*item.price
    })
    return total
})

const storePuchase = ()=>{
    itemList.value.forEach(item=>{
        if(item.quantity>0){
            form.items.push({
                id:item.id,
                quantity:item.quantity
            })
        }
    })
    Inertia.post(route('purchases.store'),form)
}

const setCustomerId = (id, name) => {
    form.customer_id = id
    form.name = name
}

</script>

<template>
    <Head title="購入画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入画面</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storePuchase">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div class="flex flex-wrap -m-2">
                                    <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="date" class="mr-4 leading-7 text-sm text-gray-600">Date</label>
                                        <input type="date" id="date" name="date" v-model="form.date" class="w-40 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        <!-- <div v-if="errors.date" class="text-red-500">{{ errors.date }}</div> -->
                                    </div>
                                    </div>
                                    <div class="p-2 w-full">
                                    <div class="relative flex">
                                        <label for="customer" class="mr-6 leading-7 text-sm text-gray-600">カナ</label>
                                        <MicroModal @update:customerId="setCustomerId"/>

                                        <!-- <select name="customer" v-model="form.customer_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                            <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                                                {{ customer.id }} : {{ customer.name }}
                                            </option>
                                        </select>
                                        <div v-if="props.errors.customer" class="text-red-500">{{ errors.customer }}</div> -->
                                    </div>
                                    </div>
                                    <div>
                                    <label for="cs_id" class="p-2 mr-6 leading-7 text-sm text-gray-600">ID</label>
                                    <input  disabled name="cs_id" v-model="form.customer_id" class="mr-4 w-24 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </div>
                                    <div>
                                    <label for="cs_name" class="mr-2 leading-7 text-sm text-gray-600">名前</label>
                                    <input  disabled name="cs_name" v-model="form.name" class="w-60 bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
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
                                            <tr v-for="item in itemList" :key="item.id">
                                                <td class="border-b-2 boder-gray-200">{{ item.id }} </td>
                                                <td class="border-b-2 boder-gray-200">{{ item.name }} </td>
                                                <td class="border-b-2 boder-gray-200">{{ item.price }} </td>
                                                <td class="border-b-2 boder-gray-200">
                                                    <select name="quantity" v-model="item.quantity">
                                                    <option v-for="q in quantity" :value="q">{{ q }}</option>
                                                    </select>
                                                </td>
                                                <td class="border-b-2 boder-gray-200">{{ item.price * item.quantity }}</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    </div>
                                    <div class="p-2 w-full">
                                    <div class="">
                                        <label for="total" class="leading-7 text-sm text-gray-600">Total</label>
                                        <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">{{ totalPrice }}円</div>
                                        <!-- <div v-if="errors.price" class="text-red-500">{{ errors.price }}</div> -->
                                    </div>
                                    </div>
                                    <div class="p-2 w-full">
                                    <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
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
