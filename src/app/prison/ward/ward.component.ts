import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { ClientelaravelService } from 'src/app/service/clientelaravel.service';
import { Ward } from 'src/app/service/Ward';

@Component({
  selector: 'app-ward',
  templateUrl: './ward.component.html',
  styleUrls: ['./ward.component.css']
})
export class WardComponent implements OnInit {

  wards: Ward[] = [];
  myFormWard!: FormGroup;
  actualizar:boolean = false;
  textBtn:string="Register";


  constructor (public servc:ClientelaravelService)
  {
    this.servc.getWards().subscribe(r=>{
      console.warn(r);
      console.table(r[0]);
    })
  }

  ngOnInit(): void {
      this.getWardsComponent()

      this.myFormWard = new FormGroup({
        idF : new FormControl(''),
        nameF: new FormControl(''),
        locationF: new FormControl(''),
        descriptionF: new FormControl(''),
      });
  }

  getWardsComponent() {
    this.servc.getWards().subscribe((r) => {
      return this.wards = r;
    });
  }

  addWardComponent()
  {
    if (this.actualizar==false)
    {
    const name = this.myFormWard.value.nameF;
    const location = this.myFormWard.value.locationF;
    const description = this.myFormWard.value.descriptionF;
    this.servc.addWard(name, location, description).subscribe((r) =>
    {

        this.getWardsComponent();

        this.myFormWard = new FormGroup({
          idF : new FormControl(''),
          nameF: new FormControl(''),
          locationF: new FormControl(''),
          descriptionF: new FormControl(''),
        });
      });
    }
    else
    {
      const id = this.myFormWard.value.idF;
      const name = this.myFormWard.value.nameF;
      const location = this.myFormWard.value.locationF;
      const description = this.myFormWard.value.descriptionF;
      this.servc
        .updateWard(name, location, description,id)
        .subscribe((r) =>
        {
          this.getWardsComponent();

          this.myFormWard = new FormGroup({
            idF : new FormControl(''),
            nameF: new FormControl(''),
            locationF: new FormControl(''),
            descriptionF: new FormControl(''),
          });
          this.textBtn = "Register"
        });

    }

  }



  updateWardComponent(id: any)
  {
    this.servc.getWardById(id).subscribe((r) =>
    {
      this.myFormWard = new FormGroup({
        idF : new FormControl(`${r.id}`),
        nameF: new FormControl(`${r.name}`),
        locationF: new FormControl(`${r.location}`),
        descriptionF: new FormControl(`${r.description}`)
      });
      this.actualizar = true;
      this.textBtn = "Update"
    });
  }





  deleteWard(id:any)
  {
    console.warn(id)
    if (!confirm('ALERTA!! va a proceder a dar de baja este pabellón'))
    {
      return false;
    }
    else
    {
      this.servc.deleteWard(id).subscribe((r) =>
      {
        this.getWardsComponent();
      });
      return true;
    }
  }

}
