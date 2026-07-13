import { Component, h } from 'vue';
import { ColumnDef } from '@tanstack/vue-table';
import { Checkbox } from '@/components/ui/checkbox';
import DataTableRowActions from '@/components/data-table/DataTableRowActions.vue';
import type { ProductTable } from '@/types';
import { productActions, type ProductTableHandlers } from './actions';

const currencyFormatter = new Intl.NumberFormat('es-PE', {
    style: 'currency',
    currency: 'PEN',
});

export const productColumns = (
    handlers: ProductTableHandlers,
): ColumnDef<ProductTable>[] => [
    {
        id: 'select',
        header: ({ table }) =>
            h(Checkbox, {
                modelValue:
                    table.getIsAllPageRowsSelected() ||
                    (table.getIsSomePageRowsSelected() && 'indeterminate'),
                'onUpdate:modelValue': (value) =>
                    table.toggleAllPageRowsSelected(!!value),
                ariaLabel: 'Seleccionar todo',
            }),
        cell: ({ row }) =>
            h(Checkbox, {
                modelValue: row.getIsSelected(),
                'onUpdate:modelValue': (value) => row.toggleSelected(!!value),
                ariaLabel: 'Seleccionar fila',
            }),
        enableSorting: false,
        enableHiding: false,
    },
    {
        accessorKey: 'id',
        header: 'ID',
    },
    {
        accessorKey: 'sku',
        header: 'SKU',
    },
    {
        accessorKey: 'name',
        header: 'Nombre',
    },
    {
        accessorKey: 'sale_price',
        header: 'Precio de Venta',
        cell: ({ row }) => {
            const price = Number.parseFloat(row.getValue('sale_price'));
            const formatted = currencyFormatter.format(price);

            return h('div', formatted);
        },
    },
    {
        accessorKey: 'minimum_stock',
        header: 'Stock Mínimo',
    },
    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            return h(DataTableRowActions as Component, {
                row: row.original,
                actions: productActions(handlers),
                title: `Acciones`,
            });
        },
    },
];
