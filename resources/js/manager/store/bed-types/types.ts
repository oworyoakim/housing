export class BedType  {
    id: number | null;
    name: string;
    capacity: string|number|null;
    totalCapacity: number;

    constructor(bedType?: any) {
        this.id = bedType?.id || null;
        this.name = bedType?.name || '';
        this.capacity = bedType?.capacity || '';
        this.totalCapacity = bedType?.totalCapacity || 0;
    }
}

export class Bed  {
    id: number | string | null;
    bedTypeId: number | string | null;
    roomId: number|null;
    numberOfBeds: string|number;

    constructor(bed?: any) {
        this.id = bed?.id || null;
        this.bedTypeId = bed?.bedTypeId || '';
        this.roomId = bed?.roomId || null;
        this.numberOfBeds = bed?.numberOfBeds || '';
    }
}
