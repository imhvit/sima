import { ColumnDef } from '@tanstack/vue-table';
import { h, type Component } from 'vue';
import type { InventoryMovementTable } from '@/types';
import DataTableRowActions from '@/components/data-table/DataTableRowActions.vue';
import {
    inventoryMovementActions,
    type InventoryMovementTableHandlers,
} from './actions';
import { Checkbox } from '@/components/ui/checkbox';

export const movementType = {
    entry: 'Ingreso',
    exit: 'Salida',
    transfer_in: 'Entrada por traslado',
    transfer_out: 'Salida por traslado',
    adjustment: 'Ajuste de inventario',
} as const;

export const reasonType = {
    purchase_received: 'Compra recibida',
    sale: 'Venta',
    transfer_dispatch: 'Despacho por traslado',
    transfer_received: 'Recepción por traslado',
    adjustment: 'Ajuste de inventario',
    customer_return: 'Devolución de cliente',
    purchase_return: 'Devolución de compra',
} as const;

export const inventoryMovementColumns = (
    handlers: InventoryMovementTableHandlers,
): ColumnDef<InventoryMovementTable>[] => [
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
        id: 'warehouse',
        header: 'Almacén',
        cell: ({ row }) => {
            const warehouse = row.original.warehouse;
            if (!warehouse)
                return h('span', { class: 'text-gray-400' }, 'Sin almacén');
            return h('div', { class: 'flex flex-col space-y-1' }, [
                h('span', warehouse.name),
                warehouse.code
                    ? h(
                          'span',
                          { class: 'text-xs text-muted-foreground' },
                          warehouse.code,
                      )
                    : null,
            ]);
        },
    },
    {
        id: 'product',
        header: 'Producto',
        cell: ({ row }) => {
            const product = row.original.product;
            if (!product)
                return h('span', { class: 'text-gray-400' }, 'Sin producto');
            return h('div', { class: 'flex flex-col space-y-1' }, [
                h('span', product.name),
                product.sku
                    ? h(
                          'span',
                          { class: 'text-xs text-muted-foreground' },
                          product.sku,
                      )
                    : null,
            ]);
        },
    },
    {
        id: 'user',
        header: 'Usuario',
        cell: ({ row }) => {
            const user = row.original.user;
            if (!user)
                return h('span', { class: 'text-gray-400' }, 'Sin producto');
            return h('div', { class: 'flex flex-col space-y-1' }, [
                h('span', user.name),
                user.email
                    ? h(
                          'span',
                          { class: 'text-xs text-muted-foreground' },
                          user.email,
                      )
                    : null,
            ]);
        },
    },
    {
        id: 'type',
        header: 'Tipo',
        cell: ({ row }) => {
            const type = row.original.type as keyof typeof movementType;
            return h(
                'span',
                { class: 'capitalize' },
                movementType[type] || type,
            );
        },
    },
    {
        id: 'quantity',
        header: 'Cantidad',
        cell: ({ row }) => {
            const quantity = row.original.quantity;
            return h('span', Number(quantity).toString());
        },
    },
    {
        id: 'stock_before',
        header: 'Stock Antes',
        cell: ({ row }) => {
            const stock_before = row.original.stock_before;
            return h('span', Number(stock_before).toString());
        },
    },
    {
        id: 'stock_after',
        header: 'Stock Después',
        cell: ({ row }) => {
            const stock_after = row.original.stock_after;
            return h('span', Number(stock_after).toString());
        },
    },
    {
        id: 'reason',
        header: 'Motivo',
        cell: ({ row }) => {
            const reason = row.original.reason as keyof typeof reasonType;
            return h(
                'span',
                { class: 'capitalize' },
                reasonType[reason] || reason,
            );
        },
    },
    {
        accessorKey: 'notes',
        header: 'Nota',
    },
    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            return h(DataTableRowActions as Component, {
                row: row.original,
                actions: inventoryMovementActions(handlers),
                title: `Acciones`,
            });
        },
    },
];
