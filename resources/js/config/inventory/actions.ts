import type { ActionDef } from '@/components/data-table/DataTableRowActions.vue';
import type { InventoryTable } from '@/types';

export interface InventoryTableHandlers {
    onOpenSheet: (inventory: InventoryTable) => void;
    onDelete: (inventory: InventoryTable) => void;
}

export const inventoryActions = (
    handlers: InventoryTableHandlers,
): ActionDef<InventoryTable>[] => [
    {
        label: 'Copiar ID',
        action: (row) => navigator.clipboard.writeText(row.id.toString()),
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
