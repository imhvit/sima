<script setup lang="ts">
import { computed, ref } from 'vue';
import { productColumns } from '@/config/columns';
import { productColumnLabels } from '@/components/data-table/labels';
import { productDetailFields } from '@/config/fields';
import type { Pagination, Product, ProductTable } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import Section from '@/components/Section.vue';
import DataTable from '@/components/data-table/DataTable.vue';
import SheetDetails from '@/components/data-table/SheetDetails.vue';
import { route } from 'ziggy-js';
import axios from 'axios';

const props = defineProps<{
    products: ProductTable[];
    pagination: Pagination;
    initialSearch?: string;
}>();

const isSheetOpen = ref(false);
const isLoadingDetails = ref(false);
const fullProductData = ref<Product | null>(null);

async function handleOpenSheet(product: ProductTable) {
    isSheetOpen.value = true;
    isLoadingDetails.value = true;
    fullProductData.value = null;

    try {
        const res = await axios.get(
            route('app.catalog.products.show', { product: product.id }),
        );
        fullProductData.value = res.data;
    } catch (error) {
        console.error('Error fetching product details:', error);
    } finally {
        isLoadingDetails.value = false;
    }
}

const columns = computed(() =>
    productColumns({
        onOpenSheet: (product: ProductTable) => handleOpenSheet(product),
        onDelete: (product: ProductTable) => {
            confirm(`Delete product with ID: ${product.id}`);
        },
    }),
);
</script>

<template>
    <AppLayout module="Productos">
        <Section>
            <DataTable
                :columns="columns"
                :pagination="pagination"
                :data="products"
                :column-labels="productColumnLabels"
                search-placeholder="Buscar por nombre..."
                :initial-search="initialSearch"
            />
        </Section>
        <SheetDetails
            v-model:open="isSheetOpen"
            :data="fullProductData"
            :fields="productDetailFields"
            :is-loading="isLoadingDetails"
            :title="'Detalles del Producto'"
            :description="'Información detallada del producto.'"
        />
    </AppLayout>
</template>
