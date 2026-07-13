import type {
    DetailField,
    FormField,
    ProductForm,
    ProductWithRelations,
    SelectOption,
} from '@/types';

export const productFormSchema = (options: {
    categories: SelectOption[];
    brands: SelectOption[];
    units: SelectOption[];
}): FormField<Partial<ProductForm>>[] => [
    {
        key: 'sku',
        label: 'Código SKU',
        type: 'text',
        required: true,
        placeholder: 'Ej. PROD-001',
    },
    {
        key: 'name',
        label: 'Nombre del Producto',
        type: 'text',
        required: true,
        placeholder: 'Ej. Producto de Alta Calidad',
    },
    {
        key: 'description',
        label: 'Descripción',
        type: 'text',
        required: true,
        placeholder: 'Ej. Este producto es ideal para...',
    },
    {
        key: 'sale_price',
        label: 'Precio de Venta',
        type: 'number',
        min: 0,
        step: 0.01,
        required: true,
        placeholder: '0',
    },
    {
        key: 'minimum_stock',
        label: 'Stock Mínimo',
        type: 'number',
        min: 0,
        required: true,
        placeholder: '0',
    },
    {
        key: 'image',
        label: 'Imagen del Producto',
        type: 'text',
        placeholder: 'URL de la imagen',
    },
    {
        key: 'category_id',
        label: 'Categoría',
        type: 'select',
        required: true,
        options: options.categories,
    },
    {
        key: 'brand_id',
        label: 'Marca',
        type: 'select',
        required: true,
        options: options.brands,
    },
    {
        key: 'unit_id',
        label: 'Unidad de Medida',
        type: 'select',
        required: true,
        options: options.units,
    },
];

export const productDetailFields: DetailField<ProductWithRelations>[] = [
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
    { key: 'category', label: 'Categoría', formatter: (val) => val.name },
    { key: 'brand', label: 'Marca', formatter: (val) => val.name },
    { key: 'unit', label: 'Unidad de Medida', formatter: (val) => val.name },
    {
        key: 'created_at',
        label: 'Fecha de Registro',
        formatter: (val) =>
            new Date(val).toLocaleDateString('es-PE', { dateStyle: 'full' }),
    },
    {
        key: 'updated_at',
        label: 'Fecha de Actualización',
        formatter: (val) =>
            new Date(val).toLocaleDateString('es-PE', { dateStyle: 'full' }),
    },
    {
        key: 'deleted_at',
        label: 'Fecha de Eliminación',
        formatter: (val) =>
            new Date(val).toLocaleDateString('es-PE', { dateStyle: 'full' }),
    },
];
