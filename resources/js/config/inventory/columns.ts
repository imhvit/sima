import { ColumnDef } from '@tanstack/vue-table';
import { h, type Component } from 'vue';
import DataTableRowActions from '@/components/data-table/DataTableRowActions.vue';
import { Checkbox } from '@/components/ui/checkbox';
import { inventoryActions, InventoryTableHandlers } from './actions';
import { InventoryTable } from '@/types';

export const inventoryColumns = (
    handlers: InventoryTableHandlers,
): ColumnDef<InventoryTable>[] => [
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
        id: 'product_name',
        header: 'Producto',
        cell: ({ row }) => {
            const product = row.original.product;
            if (!product)
                return h('span', { class: 'text-gray-400' }, 'Sin Producto');
            return h('div', { class: 'flex flex-col space-y-1' }, product.name);
        },
    },
    {
        id: 'product_sku',
        header: 'SKU',
        cell: ({ row }) => {
            const product = row.original.product;
            if (!product)
                return h('span', { class: 'text-gray-400' }, 'Sin SKU');
            return h('div', { class: 'flex flex-col space-y-1' }, product.sku);
        },
    },
    {
        id: 'warehouse',
        header: 'Almacén',
        cell: ({ row }) => {
            const warehouse = row.original.warehouse;
            if (!warehouse)
                return h('span', { class: 'text-gray-400' }, 'Sin almacén');
            return h(
                'div',
                { class: 'flex flex-col space-y-1' },
                warehouse.name,
            );
        },
    },
    {
        accessorKey: 'stock',
        header: 'Stock',
    },
    {
        accessorKey: 'reserved_stock',
        header: 'Stock Reservado',
    },
    {
        accessorKey: 'available_stock',
        header: 'Stock Disponible',
    },
    {
        id: 'product_deleted_at',
        header: 'Estado',
        cell: ({ row }) => {
            const product = row.original.product;
            if (!product)
                return h('span', { class: 'text-gray-400' }, 'Sin Producto');
            if (product.deleted_at)
                return h('span', { class: 'text-red-500' }, 'Eliminado');
            return h('span', { class: 'text-green-500' }, 'Activo');
        },
    },
    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            return h(DataTableRowActions as Component, {
                row: row.original,
                actions: inventoryActions(handlers),
                title: `Acciones`,
            });
        },
    },
];
