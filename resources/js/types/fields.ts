export interface DetailField<T = any> {
    key: keyof T;
    label: string;
    // Callback opcional para transformar el valor (ej. booleanos a "Sí/No", monedas)
    formatter?: (value: any) => string | number;
}
