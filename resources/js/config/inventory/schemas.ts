import type { Category, CategoryForm, DetailField, FormField } from '@/types';

function dateFormatter(value: string | null): string {
    if (!value) return 'N/A';
    return new Date(value).toLocaleDateString('es-PE', { dateStyle: 'full' });
}

export const categoryFormSchema: FormField<Partial<CategoryForm>>[] = [
    {
        key: 'name',
        label: 'Nombre',
        type: 'text',
        required: true,
        placeholder: 'Ej. Electrónica',
    },
    {
        key: 'description',
        label: 'Descripción',
        type: 'text',
        required: true,
        placeholder: 'Ej. Esta categoría incluye productos de alta calidad...',
    },
];

export const categoryDetailSchema: DetailField<Category>[] = [
    { key: 'id', label: 'ID' },
    { key: 'name', label: 'Nombre' },
    { key: 'description', label: 'Descripción' },
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
