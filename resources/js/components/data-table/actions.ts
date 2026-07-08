import type { ActionDef } from './DataTableRowActions.vue';
import type { CategoryTable, ProductTable } from '@/types';

export const productActions: ActionDef<ProductTable>[] = [
    {
        label: 'Copiar ID del producto',
        action: (row) => navigator.clipboard.writeText(row.id.toString()),
    },
    { separator: true },
    {
        label: 'Ver detalles',
        action: (row) => console.log('Navegando a detalles de', row.sku),
    },
    {
        label: 'Desactivar',
        destructive: true,
        action: (row) => console.warn('Desactivando producto', row.id),
    },
];
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
