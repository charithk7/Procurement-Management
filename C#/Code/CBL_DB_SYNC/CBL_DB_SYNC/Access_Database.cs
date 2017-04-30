using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Data.OleDb;
using System.Windows.Forms;
using System.Data;

namespace CBL_DB_SYNC
{
    class Access_Database
    {

        private OleDbConnection access_Con;
       // private OleDbCommand oleDbCmd = new OleDbCommand();
        private static OleDbCommand query;
        static OleDbDataReader dataReader;
        string OleDBPassword;
        //parameter from mdsaputra.udl
       
        public  Access_Database(string path)
        {
            //  String connParam = @"Provider=Microsoft.Jet.OLEDB.4.0;Data Source="+path+";Persist Security Info=False";
           // OleDbConnection Access_conn = new OleDbConnection();
            OleDBPassword="1";
            String connection = "Provider=Microsoft.ACE.OLEDB.12.0;Data Source=" + path + ";JET OLEDB:Database Password=" + OleDBPassword + ";Persist Security Info=True";

            access_Con = new OleDbConnection(connection);
           // access_Con.Open();
        }
        public void open_Access_DB()
        {
            if (access_Con.State == ConnectionState.Closed)
            {
                access_Con.Open();
            }
        }

        public void closeDB()
        {
            if (access_Con.State == ConnectionState.Open)
            {
                access_Con.Close();
            }
        }
        public OleDbDataReader getdata(int last_id)
        {
          //  access_Con.Open();
            query = new OleDbCommand("SELECT * FROM RECORDS where ID > "+last_id, access_Con);//where ID > 12000

            // Execute the query on the database and get the data
            dataReader = query.ExecuteReader();
            return dataReader;

           
        }
        public OleDbDataReader last_id()
        {
           // access_Con.Open();
            query = new OleDbCommand("SELECT LAST(ID) FROM RECORDS ", access_Con);//where ID > 12000

            // Execute the query on the database and get the data
            dataReader = query.ExecuteReader();
            return dataReader;


        }
        
    }
}
