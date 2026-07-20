import type { DetailField, InventoryMovementWithRelations } from '@/types';
import { movementType, reasonType } from './columns';

function dateFormatter(value: string | null): string {
    if (!value) return 'N/A';
    return new Date(value).toLocaleDateString('es-PE', { dateStyle: 'full' });
}

export const inventoryMovementDetailSchema: DetailField<InventoryMovementWithRelations>[] =
    [
        { key: 'id', label: 'ID' },
        {
            key: 'warehouse',
            label: 'Almacén',
            formatter: (value) => `${value.name} (${value.code})`,
        },
        {
            key: 'product',
            label: 'Producto',
            formatter: (value) => `${value.name} (${value.sku})`,
        },
        {
            key: 'user',
            label: 'Usuario',
            formatter: (value) => value.name,
        },
        {
            key: 'type',
            label: 'Tipo',
            formatter: (value: keyof typeof movementType) =>
                movementType[value] || value,
        },
        { key: 'quantity', label: 'Cantidad' },
        { key: 'stock_before', label: 'Stock Antes' },
        { key: 'stock_after', label: 'Stock Después' },
        {
            key: 'reason',
            label: 'Motivo',
            formatter: (value: keyof typeof reasonType) =>
                reasonType[value] || value,
        },
        { key: 'notes', label: 'Notas' },
        {
            key: 'created_at',
            label: 'Fecha de Registro',
            formatter: dateFormatter,
        },
        {
            key: 'updated_at',
            label: 'Fecha de Actualización',
            formatter: dateFormatter,
        },
        {
            key: 'deleted_at',
            label: 'Fecha de Eliminación',
            formatter: dateFormatter,
        },
    ];
