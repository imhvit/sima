<script setup lang="ts">
import DataTable from '@/components/data-table/DataTable.vue';
import { inventoryMovementColumnLabels } from '@/components/data-table/labels';
import SheetDetails from '@/components/data-table/SheetDetails.vue';
import Section from '@/components/Section.vue';
import {
    inventoryMovementColumns,
    inventoryMovementDetailSchema,
} from '@/config/movement';
import AppLayout from '@/layouts/AppLayout.vue';
import {
    InventoryMovementTable,
    InventoryMovementWithRelations,
    Pagination,
} from '@/types';
import axios from 'axios';
import { computed, ref } from 'vue';
import { route } from 'ziggy-js';

const props = defineProps<{
    movements: InventoryMovementTable[];
    pagination: Pagination;
    initialSearch?: string;
}>();

const isSheetOpen = ref(false);
const isLoadingDetails = ref(false);
const fullProductData = ref<InventoryMovementWithRelations | null>(null);

async function handleOpenSheet(movement: InventoryMovementTable) {
    isSheetOpen.value = true;
    isLoadingDetails.value = true;
    fullProductData.value = null;

    try {
        const res = await axios.get(
            route('app.inventory.movements.show', { movement: movement.id }),
        );
        fullProductData.value = res.data;
    } catch (error) {
        console.error('Error fetching movement details:', error);
    } finally {
        isLoadingDetails.value = false;
    }
}

const columns = computed(() =>
    inventoryMovementColumns({
        onOpenSheet: handleOpenSheet,
        onDelete: (movement) => {
            console.log('Delete movement:', movement);
        },
    }),
);
</script>

<template>
    <AppLayout module="Movimientos">
        <Section>
            <DataTable
                :columns="columns"
                :pagination="pagination"
                :data="movements"
                :column-labels="inventoryMovementColumnLabels"
                :disable-input-search="true"
            />
            <SheetDetails
                v-model:open="isSheetOpen"
                :data="fullProductData"
                :fields="inventoryMovementDetailSchema"
                :is-loading="isLoadingDetails"
                title="Detalles del Movimiento"
                description="Información detallada del movimiento."
            />
        </Section>
    </AppLayout>
</template>
