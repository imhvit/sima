export interface Category {
    id: number;
    name: string;
    description: string;
    created_at: string;
    updated_at: string;
    deleted_at: string | null;
}

export type CategoryTable = Pick<Category, 'id' | 'name' | 'description'>;

export type CategoryForm = Omit<
    Category,
    'id' | 'created_at' | 'updated_at' | 'deleted_at'
>;
