import { ActionDef } from './DataTableRowActions.vue';
import type { ProductTable } from '@/types';

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
