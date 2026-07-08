import { DetailField, Product } from '@/types';

export const productDetailFields: DetailField<Product>[] = [
    { key: 'id', label: 'ID del Sistema' },
    { key: 'sku', label: 'Código SKU' },
    { key: 'name', label: 'Nombre del Producto' },
    { key: 'description', label: 'Descripción' },
    {
        key: 'sale_price',
        label: 'Precio de Venta',
        formatter: (val) =>
            new Intl.NumberFormat('es-PE', {
                style: 'currency',
                currency: 'PEN',
            }).format(val),
    },
    { key: 'minimum_stock', label: 'Stock Mínimo' },
    {
        key: 'image',
        label: 'Imagen del Producto',
    },
    {
        key: 'is_active',
        label: 'Estado',
        formatter: (val) => (val ? 'Activo' : 'Inactivo'),
    },
    {
        key: 'created_at',
        label: 'Fecha de Registro',
        formatter: (val) =>
            new Date(val).toLocaleDateString('es-PE', { dateStyle: 'long' }),
    },
    {
        key: 'updated_at',
        label: 'Fecha de Actualización',
        formatter: (val) =>
            new Date(val).toLocaleDateString('es-PE', { dateStyle: 'long' }),
    },
    {
        key: 'deleted_at',
        label: 'Fecha de Eliminación',
        formatter: (val) =>
            new Date(val).toLocaleDateString('es-PE', { dateStyle: 'long' }),
    },
];
