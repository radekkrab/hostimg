<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';


</script>

<template>
    <Head title="Хостинг изображений" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Хостинг изображений</h2>
            <Link :href="route('json')"><h1>Получить JSON всех объектов</h1></Link>
        </template>

        <div class="py-12">
            <ul class="flex gap-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <li class="bg-white overflow-hidden shadow-sm sm:rounded-lg"
                    v-for="image in $page.props.imgs">
                    <a :href="image['img_path']"><img width="200px"  :src="image['img_path']" alt="1"></a>
                    <p>Название: {{ image['img_name'] }}</p>
                    <p>Дата и время загрузки: {{ new Date(image['created_at']).toLocaleString() }}</p>
                    <a :href="'zip/' + image['img_name']">Скачать ZIP-архив</a><br></br>
                    <a :href="'json/' + image['id']">Получить JSON изображения</a>
                </li>
            </ul>
        </div>
    </AuthenticatedLayout>
</template>
