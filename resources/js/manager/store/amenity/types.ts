export class Amenity {
    id: number|null;
    name: string;
    description: string;

    constructor(amenity?: any) {
        this.id = amenity?.id || null;
        this.name = amenity?.name || '';
        this.description = amenity?.description || '';
    }
}
