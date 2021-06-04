export class RoomOrServiceCategory {
    id: number|null;
    name:  string|null;
    description:  string|null;

    constructor(roomOrService?: any) {
        this.id = roomOrService?.id || null;
        this.name = roomOrService?.name || '';
        this.description = roomOrService?.description || '';
    }
}
