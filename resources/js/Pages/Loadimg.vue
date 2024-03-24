<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    img: null,
})

function submit() {
    if (!(form.img && form.img.length <= 5)) {
        alert('Можно загрузить не более 5 изображений');
    } else {
        form.post('/storeimg')
    }

}

</script>

<template>
    <Head title="Загрузка изображений" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Загрузка изображений</h2>
        </template>

        <form class="mt-5 max-w-[400px] flex items-center justify-between p-5 gap-3 mx-auto border-2 border-blue-950 rounded-2xl bg-lime-400" @submit.prevent="submit">
            <input type="file" accept="image/*" multiple @input="form.img = $event.target.files" />
            <progress  v-if="form.progress" :value="form.progress.percentage" max="100">
                {{ form.progress.percentage }}%
            </progress>
            <button type="submit">Отправить</button>
        </form>
    </AuthenticatedLayout>
</template>
