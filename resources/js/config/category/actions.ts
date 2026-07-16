import type { ActionDef } from '@/components/data-table/DataTableRowActions.vue';
import type { CategoryTable } from '@/types';

export interface CategoryTableHandlers {
    onOpenSheet: (category: CategoryTable) => void;
    onOpenForm: (type: 'edit' | 'create', category: CategoryTable) => void;
    onDelete: (category: CategoryTable) => void;
}

export const categoryActions = (
    handlers: CategoryTableHandlers,
): ActionDef<CategoryTable>[] => [
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
        label: 'Editar',
        action: (row) => handlers.onOpenForm('edit', row),
    },
    {
        label: 'Eliminar',
        destructive: true,
        action: (row) => handlers.onDelete(row),
    },
];
