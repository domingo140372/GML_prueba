import pymysql as db
import sys
import requests as req

config = {
    'host': 'localhost',
    'port': 3306,
    'db': 'usuarios_gml',
    'user':'root',
    'password':'M0ns3rr4tH0102#',
}


__PAISES = 'https://restcountries.com/v3.1/region/americas'


def connect(config:dict):
    try:
        conexion = db.connect(**config)
    except db.Error as error:
        print(f"Conexion Error: {error}")
        sys.exit(1)
    
    return conexion

def consumirApi():
    data = req.get(__PAISES)
    result = data.json()
    
    return(result)


if __name__=="__main__":
    paises = consumirApi()

    for pais in paises:
        nombre = pais['name']['common']
        lat = pais['latlng'][0]
        long = pais['latlng'][1]
        #print('{'f"""nombre:{nombre}, latitud:{lat}, longitud:{long}""" '}')
        conn = connect(config=config)
        cursor = conn.cursor()
        __QUUERY = f"""INSERT INTO paises (nombre_pais, latitud, longitud) 
                        VALUES('{nombre}','{lat}','{long}');
                    """
        
        try:
            cursor.execute(__QUUERY)
            conn.commit()
            print(f'insertando pais: {nombre}')
        
        except db.Error as error:
            print(error)
            conn.rollback()
            sys.exit(1)


    
