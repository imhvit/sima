import type { ActionDef } from '@/components/data-table/DataTableRowActions.vue';
import type { CategoryTable } from '@/types';

export const categoryActions: ActionDef<CategoryTable>[] = [
    {
        label: 'Copiar ID de la categoría',
        action: (row) => navigator.clipboard.writeText(row.id.toString()),
    },
    { separator: true },
    {
        label: 'Ver detalles',
        action: (row) => console.log('Navegando a detalles de', row.name),
    },
    {
        label: 'Desactivar',
        destructive: true,
        action: (row) => console.warn('Desactivando producto', row.id),
    },
];
