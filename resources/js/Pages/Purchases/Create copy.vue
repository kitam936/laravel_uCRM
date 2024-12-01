<script setup>

import {getToday} from '@/common/'
import { onMounted,reactive ,ref, computed} from 'vue';
import { useForm } from '@inertiajs/vue3'
import { Inertia } from '@inertiajs/inertia';

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

</script>

<template>
    <form @submit.prevent="storePuchase">
    日付<br>
    <input type="date" name="date" v-model="form.date"><br>
    会員名<br>
    <select name="customer" v-model="form.customer_id">
    <option v-for="customer in customers" :value="customer.id" :key="customer.id">
        {{ customer.id }} : {{ customer.name }}
    </option>
    </select>

    商品・サービス<br>
    <table>
    <thead>
        <th>id</th>
        <th>品名</th>
        <th>単価</th>
        <th>数量</th>
        <th>小計</th>
    </thead>
    <tbody>
        <tr v-for="item in itemList" >
        <td>{{ item.id }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.price }}</td>
        <td>
            <select name="quantity" v-model="item.quantity">
            <option v-for="q in quantity" :value="q">{{ q }}</option>
            </select>
        </td>
        <td>
        {{ item.price * item.quantity }}
        </td>
        </tr>
    </tbody>
    </table>
    Total {{ totalPrice }}<br>
    <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
    </form>

</template>

