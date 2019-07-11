import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { Clientes } from 'src/app/classes/clientes';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  clientes: Clientes[];
  selectedCliente: Clientes = {cpf: null, nome: null, endereco: null };

  constructor(private apiService: ApiService) { }

  ngOnInit() {
    this.apiService.readClientes().subscribe( (clientes: Clientes[]) => {
      this.clientes = clientes;
      console.log(this.clientes);
    });
  }

  createOrUpdateCliente(form) {
    if (/*this.selectedCliente &&*/ this.selectedCliente.endereco) {

      form.value.nome = this.selectedCliente.nome;
      this.apiService.updateCliente(form.value).subscribe((cliente: Clientes) => {
        console.log('Cliente updated' , cliente);
      });

    } else {

      this.apiService.createCliente(form.value).subscribe((cliente: Clientes) => {
        console.log('Cliente criado', cliente);
      });
    }

  }

  selectCliente(cliente: Clientes) {
    this.selectedCliente = cliente;
  }

  deleteCliente(cpf) {
    this.apiService.deleteCliente(cpf).subscribe((cliente: Clientes) => {
      console.log('Cliente deleted, ', cliente);
    });
  }

}
