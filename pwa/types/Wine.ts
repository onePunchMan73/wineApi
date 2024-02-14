import { Item } from "./item";

export class Wine implements Item {
  public "@id"?: string;

  constructor(
    _id?: string,
    public name?: string,
    public description?: string,
    public createdAt?: Date,
    public updatedAt?: Date,
    public isActive?: boolean,
    public active?: boolean
  ) {
    this["@id"] = _id;
  }
}
