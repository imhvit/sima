import { Product } from './product';
import { Warehouse } from './warehouse';

export interface InventoryRelations {
    warehouse: Warehouse;
    product: Product;
}

export interface Inventory {
    id: number;
    warehouse_id: number;
    product_id: number;
    stock: number;
    reserved_stock: number;
    created_at: string;
    updated_at: string;
    // id: number;
    // product_name: string;
    // product_sku: string;
    // warehouse: string;
    // stock: number;
    // reserved_stock: number;
    // available_stock: number;
    // product_deleted_at: string | null;
}

export type InventoryTable = Inventory & {
    warehouse: Pick<Warehouse, 'id' | 'name' | 'code'>;
    product: Pick<Product, 'id' | 'name' | 'sku' | 'deleted_at'>;
};

export type InventoryWithRelations = Inventory & InventoryRelations;
