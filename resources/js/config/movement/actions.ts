import type { ActionDef } from '@/components/data-table/DataTableRowActions.vue';
import type { InventoryMovementTable } from '@/types';

export interface InventoryMovementTableHandlers {
    onOpenSheet: (movement: InventoryMovementTable) => void;
    onDelete: (movement: InventoryMovementTable) => void;
}

export const inventoryMovementActions = (
    handlers: InventoryMovementTableHandlers,
): ActionDef<InventoryMovementTable>[] => [
    {
        label: 'Copiar ID',
        action: (row) => navigator.clipboard.writeText(row.id.toString()),
    },
    {
        label: 'Copiar código de almacén',
        action: (row) =>
            navigator.clipboard.writeText(row.warehouse?.code || ''),
    },
    {
        label: 'Copiar SKU del producto',
        action: (row) => navigator.clipboard.writeText(row.product?.sku || ''),
    },
    { separator: true },
    {
        label: 'Ver detalles',
        action: (row) => handlers.onOpenSheet(row),
    },
    {
        label: 'Eliminar',
        destructive: true,
        action: (row) => handlers.onDelete(row),
    },
];
