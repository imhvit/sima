<script setup lang="ts">
import { productColumns } from '@/components/data-table/columns';
import { productColumnLabels } from '@/components/data-table/labels';
import DataTable from '@/components/data-table/DataTable.vue';
import Section from '@/components/Section.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type { ProductTable } from '@/types';

const props = defineProps<{
    products: ProductTable[];
}>();
</script>

<template>
    <AppLayout module="Productos">
        <Section>
            <DataTable
                :columns="productColumns"
                :data="products"
                :column-labels="productColumnLabels"
                search-placeholder="Buscar por nombre..."
            />
        </Section>
    </AppLayout>
</template>
