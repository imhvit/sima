export interface Product {
    id: number;
    category_id: number;
    brand_id: number;
    unit_id: number;
    sku: string;
    name: string;
    description: string;
    sale_price: number;
    minimum_stock: number;
    image: string | null;
    is_active: boolean;
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
}

export type ProductTable = Pick<
    Product,
    'id' | 'sku' | 'name' | 'sale_price' | 'minimum_stock' | 'is_active'
>;
