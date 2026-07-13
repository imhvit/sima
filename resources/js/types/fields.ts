export interface DetailField<T = any> {
    key: keyof T;
    label: string;
    formatter?: (value: any) => string | number;
}
