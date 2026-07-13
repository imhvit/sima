import type { ActionDef } from '@/components/data-table/DataTableRowActions.vue';
import type { ProductTable } from '@/types';

export interface ProductTableHandlers {
    onOpenSheet: (product: ProductTable) => void;
    onOpenForm: (type: 'edit' | 'create', product: ProductTable) => void;
    onDelete: (product: ProductTable) => void;
}

export const productActions = (
    handlers: ProductTableHandlers,
): ActionDef<ProductTable>[] => [
    {
        label: 'Copiar ID',
        action: (row) => navigator.clipboard.writeText(row.id.toString()),
    },
    {
        label: 'Copiar SKU',
        action: (row) => {
            navigator.clipboard.writeText(row.sku);
        },
    },
    { separator: true },
    {
        label: 'Ver detalles',
        action: (row) => handlers.onOpenSheet(row),
    },
    {
        label: 'Editar',
        action: (row) => handlers.onOpenForm('edit', row),
    },
    {
        label: 'Eliminar',
        destructive: true,
        action: (row) => handlers.onDelete(row),
    },
];
