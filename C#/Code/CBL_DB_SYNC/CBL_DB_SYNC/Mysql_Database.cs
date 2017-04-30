using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using MySql.Data.MySqlClient;
using System.Data;


namespace CBL_DB_SYNC
{
    class Mysql_Database
    {
        // my sql part
        MySqlConnection mysql_con = null;

        MySqlDataReader MyReader2;
      
        
        //string server = "";
       // string database = "";
      // // string user = "";
      //  string password = "";
      // string port = "";

        // access part

        public Mysql_Database(string server, string database, string port, string user, string password)
        {
            string MYSQL_CON_STR = "server=" + server + ";user=" + user + ";database=" + database + ";port=" + port + ";password=" + password + ";";
            mysql_con = new MySqlConnection(MYSQL_CON_STR);
          //  mysql_con.Open();

        }

        public void mysql_openDB()
        {
            if (mysql_con.State == ConnectionState.Closed)
            {
                mysql_con.Open();
            }
        }


        public void mysql_closeDB()
        {
            if (mysql_con.State == ConnectionState.Open)
            {
                mysql_con.Close();
            }
        }
        public void insert_data(string Query)
        {
            MySqlCommand MyCommand2 = new MySqlCommand(Query, mysql_con);

            MyReader2 = MyCommand2.ExecuteReader();
            MyReader2.Close();
        }

        public Boolean is_empty_table (string Query)
        {
            MySqlCommand MyCommand2 = new MySqlCommand(Query, mysql_con);

            MyReader2 = MyCommand2.ExecuteReader();
            if (MyReader2.HasRows)
            {
                MyReader2.Close();
                return true;

            }
            else
            {
                MyReader2.Close();
                return false;
            }
          
        }

        public MySqlDataReader get_last_id()
        {
           // string id="";
            string Query = "SELECT * FROM `system_settings` WHERE settings_name='last_id'";
            MySqlCommand MyCommand2 = new MySqlCommand(Query, mysql_con);
           
            return MyCommand2.ExecuteReader();
             
        }


    }
}
