import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { Clientes } from './classes/clientes';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  PHP_API_SERVER = 'http://127.0.0.1/phpAngula/backend';

  constructor(private httpClient: HttpClient) {}

  readClientes(): Observable<Clientes[]> {
    return this.httpClient.get<Clientes[]>(`${this.PHP_API_SERVER}/api/read.php`);
  }

  createCliente(cliente: Clientes): Observable<Clientes> {
    return this.httpClient.post<Clientes>(`${this.PHP_API_SERVER}/api/create.php`, cliente);
  }

  updateCliente(cliente: Clientes) {
    return this.httpClient.put<Clientes>(`${this.PHP_API_SERVER}/api/update.php`, cliente);  }

  deleteCliente(cpfCliente: string) {
    return this.httpClient.delete<Clientes>(`${this.PHP_API_SERVER}/api/delete.php/?cpf=${cpfCliente}`);
  }

}
