import { ColumnDef } from '@tanstack/vue-table';
import { h, type Component } from 'vue';
import type { CategoryTable } from '@/types';
import DataTableRowActions from '@/components/data-table/DataTableRowActions.vue';
import { categoryActions, type CategoryTableHandlers } from './actions';
import { Checkbox } from '@/components/ui/checkbox';

export const categoryColumns = (
    handlers: CategoryTableHandlers,
): ColumnDef<CategoryTable>[] => [
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
        accessorKey: 'name',
        header: 'Nombre',
    },
    {
        accessorKey: 'description',
        header: 'Descripción',
    },
    {
        id: 'actions',
        enableHiding: false,
        cell: ({ row }) => {
            return h(DataTableRowActions as Component, {
                row: row.original,
                actions: categoryActions(handlers),
                title: `Acciones`,
            });
        },
    },
];
