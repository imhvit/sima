export const productColumnLabels: Record<string, string> = {
    id: 'ID',
    sku: 'SKU',
    name: 'Nombre',
    sale_price: 'Precio de Venta',
    minimum_stock: 'Stock Mínimo',
};

export const categoryColumnLabels: Record<string, string> = {
    id: 'ID',
    name: 'Nombre',
    description: 'Descripción',
};

export const inventoryMovementColumnLabels: Record<string, string> = {
    id: 'ID',
    warehouse: 'Almacén',
    product: 'Producto',
    user: 'Usuario',
    type: 'Tipo',
    quantity: 'Cantidad',
    stock_before: 'Stock Antes',
    stock_after: 'Stock Después',
    reason: 'Motivo',
    notes: 'Notas',
};
