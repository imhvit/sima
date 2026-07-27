<script setup lang="ts">
import DataTable from '@/components/data-table/DataTable.vue';
import { inventoryColumnLabels } from '@/components/data-table/labels';
import Section from '@/components/Section.vue';
import { inventoryColumns } from '@/config/inventory';
import AppLayout from '@/layouts/AppLayout.vue';
import { Pagination } from '@/types';
import { InventoryTable } from '@/types/inventory/inventory';
import { computed } from 'vue';

const props = defineProps<{
    pagination: Pagination;
    inventory: InventoryTable[];
}>();
console.log(props.inventory);

const columns = computed(() =>
    inventoryColumns({
        onOpenSheet: (inventory) => {
            console.log('Open inventory sheet:', inventory);
        },
        onDelete: (inventory) => {
            console.log('Delete inventory:', inventory);
        },
    }),
);
</script>

<template>
    <AppLayout module="Stock">
        <Section>
            <DataTable
                :columns="columns"
                :pagination="pagination"
                :data="inventory"
                :column-labels="inventoryColumnLabels"
                :disable-input-search="true"
            />
        </Section>
    </AppLayout>
</template>
