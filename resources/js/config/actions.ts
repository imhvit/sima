import type { ActionDef } from '@/components/data-table/DataTableRowActions.vue';
import type { CategoryTable, ProductTable } from '@/types';

export interface ProductTableHandlers {
    onOpenSheet: (product: ProductTable) => void;
    onDelete: (product: ProductTable) => void;
}

export const productActions = (
    handlers: ProductTableHandlers,
): ActionDef<ProductTable>[] => [
    {
        label: 'Copiar ID del producto',
        action: (row) => navigator.clipboard.writeText(row.id.toString()),
    },
    { separator: true },
    {
        label: 'Ver detalles',
        action: (row) => handlers.onOpenSheet(row),
    },
    {
        label: 'Desactivar',
        destructive: true,
        action: (row) => handlers.onDelete(row),
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
