<script setup lang="ts">
import { categoryColumns } from '@/config/columns';
import DataTable from '@/components/data-table/DataTable.vue';
import { categoryColumnLabels } from '@/components/data-table/labels';
import Section from '@/components/Section.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { CategoryTable, Pagination } from '@/types';

const props = defineProps<{
    categories: CategoryTable[];
    pagination: Pagination;
    initialSearch?: string;
}>();
</script>

<template>
    <AppLayout module="Categorías">
        <Section>
            <DataTable
                :columns="categoryColumns"
                :pagination="pagination"
                :data="categories"
                :column-labels="categoryColumnLabels"
                search-placeholder="Buscar por nombre..."
                :initial-search="initialSearch"
            />
        </Section>
    </AppLayout>
</template>
