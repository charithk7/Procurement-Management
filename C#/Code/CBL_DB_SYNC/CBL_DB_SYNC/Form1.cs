using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading;
using System.Windows.Forms;

namespace CBL_DB_SYNC
{
    public partial class Form1 : Form
    {
        int call_flag = 0;
       
        public delegate void UpdateTerminal1(string str);

        public Form1()
        {
            InitializeComponent();
        }

        private void btn_settings_Click(object sender, EventArgs e)
        {
            getDBSettings();

            panel_login.Visible = true;
            panel_login.BringToFront();
            this.ActiveControl = txt_username;
           
        }

        private void btn_back_Click(object sender, EventArgs e)
        {
            panel_settings.Visible = false;
            
        }

        private void Form1_Load(object sender, EventArgs e)
        {
           
            getDBSettings();

            if (database_status())
            {
                set_last_id();
                timer1.Enabled = true;
                
                this.WindowState = FormWindowState.Minimized;
            }
         

        }
       
        public Boolean getDBSettings()
        {
            int counter = 0;
            string line;


            try
            {
                // Read the file and display it line by line.
                System.IO.StreamReader file =
                   new System.IO.StreamReader(AppDomain.CurrentDomain.BaseDirectory + "\\settings.txt");
                while ((line = file.ReadLine()) != null)
                {
                   
                    if (counter == 0)
                    {
                        txt_access_path.Text = line;

                    }

                    else if (counter == 1)
                    {

                        txt_access_password.Text = line;
                    }
                    else if (counter == 2)
                    {

                        txt_nex_server.Text = line;
                    }
                    else if (counter == 3)
                    {

                        txt_nex_database.Text = line;
                    }
                    else if (counter == 4)
                    {

                        txt_nex_port.Text = line;
                    }
                    else if (counter == 5)
                    {

                        txt_nex_username.Text = line;
                    }
                    else if (counter == 6)
                    {

                        txt_nex_password.Text = line;
                    }
                    else if (counter == 7)
                    {

                        txt_request_link.Text = line;
                    }
                    else if (counter == 8)
                    {
                        if (line == "1")
                        {
                            checkBox_fun_disable.Checked = true;
                            checkBox_fun_disable.Text = "Enable GRN SYNC";
                        }
                        else if (line == "0")
                        {
                            checkBox_fun_disable.Checked = false;
                            checkBox_fun_disable.Text = "Disable GRN SYNC";
                            
                        }
                    }
                    else if (counter == 9)
                    {

                        if (line == "1")
                        {
                            checkBox_btn_hide.Checked = true;
                            checkBox_btn_hide.Text = "Button Show";
                        }
                        else if (line == "0")
                        {
                            checkBox_btn_hide.Checked = false;
                            checkBox_btn_hide.Text = "Button Hide";
                        }
                    }
                        counter++;
                }

                file.Close();

                // Suspend the screen.
                return true;
            }
            catch (Exception)
            {
                return false;



            }


        }

        public Boolean database_status()
        {
            try
            {


                Mysql_Database mysql_obj = new Mysql_Database(txt_nex_server.Text, txt_nex_database.Text, txt_nex_port.Text, txt_nex_username.Text, txt_nex_password.Text);
                mysql_obj.mysql_openDB();
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Mysql Database Connected" });
                btn_my_sql_database.BackColor = Color.ForestGreen;
                mysql_obj.mysql_closeDB();


            }
            catch (Exception)
            {
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Mysql Database Error" });
                btn_my_sql_database.BackColor = Color.Red;
                return false;
            }


            try
            {


                Access_Database obj = new Access_Database(txt_access_path.Text);
                obj.open_Access_DB();
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Access Database Connected" });
                btn_access_database.BackColor = Color.ForestGreen;
                obj.closeDB();

                
                return true;

            }
            catch (Exception)
            {
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Access Database Error" });
                btn_access_database.BackColor = Color.Red;
                return false;
            }
        }

        public void set_last_id()
        {


          
            
            try
            {
                Mysql_Database mysqlobj = new Mysql_Database(txt_nex_server.Text, txt_nex_database.Text, txt_nex_port.Text, txt_nex_username.Text, txt_nex_password.Text);
                mysqlobj.mysql_openDB();

                string is_id="";
                IDataReader li = mysqlobj.get_last_id();
                while (li.Read())
                {
                    is_id = li.GetValue(2).ToString();
                }

                li.Close();

                if (is_id == "")
                {
                    Access_Database obj = new Access_Database(txt_access_path.Text);
                    obj.open_Access_DB();
                    IDataReader last_id = obj.last_id();
                    string last_id_int = " ";
                    while (last_id.Read())
                    {
                        last_id_int = last_id.GetValue(0).ToString();

                    }
                    obj.closeDB();


                    //   Mysql_Database mysqlobj = new Mysql_Database(txt_nex_server.Text, txt_nex_database.Text, txt_nex_port.Text, txt_nex_username.Text, txt_nex_password.Text);
                    //  mysqlobj.mysql_openDB();
                    String insSQL = "INSERT INTO system_settings(`settings_name`, `value`)VALUES('last_id','" + last_id_int + "') ";
                    mysqlobj.insert_data(insSQL);
                    mysqlobj.mysql_closeDB();
                    this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "First time Initial   " });
                }
                else
                {
                    this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Initial ok...  "  });
                }
               
              
            }
            catch (System.IO.IOException ex)
            {
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Initial update error : " + ex });
            }
           
        }

        public void set_last_id(string id)
        {

           
            try
            {
                Mysql_Database mysqlobj = new Mysql_Database(txt_nex_server.Text, txt_nex_database.Text, txt_nex_port.Text, txt_nex_username.Text, txt_nex_password.Text);
                mysqlobj.mysql_openDB();
                String insSQL = "UPDATE `system_settings` SET `value`= '" + id + "' WHERE `settings_name`='last_id'";
                mysqlobj.insert_data(insSQL);
                mysqlobj.mysql_closeDB();


            }
            catch (System.IO.IOException ex)
            {
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Error update last id : " + ex });
            }

        }

        public string format_date(string date)
        {

            String[] format_date = date.Split('/', ' ', ':');
            DateTime timeValue = Convert.ToDateTime(format_date.GetValue(3).ToString() + ":" + format_date.GetValue(4).ToString() + ":" + format_date.GetValue(5).ToString() + " " + format_date.GetValue(6).ToString());
            // Console.WriteLine(timeValue.ToString("HH:mm"));
            string output = format_date.GetValue(2).ToString() + "-" + format_date.GetValue(0).ToString() + "-" + format_date.GetValue(1).ToString() + " " + timeValue.ToString("HH:mm:ss");
            return output;

        }

        public void sync_database()
        {
            string data_id = "";
            try
            {
                string  last_id = "";
                Mysql_Database mysqlobj = new Mysql_Database(txt_nex_server.Text, txt_nex_database.Text, txt_nex_port.Text, txt_nex_username.Text, txt_nex_password.Text);
                mysqlobj.mysql_openDB();


             IDataReader li=  mysqlobj.get_last_id();
             while (li.Read())
             {
                 last_id = li.GetValue(1).ToString();
             }

             li.Close();
               
                Access_Database obj = new Access_Database(txt_access_path.Text);
                obj.open_Access_DB();
              //  if(last_id!=null)
                 IDataReader abc = obj.getdata(Int32.Parse(last_id));
               
                int rowcount = 0;
              //  Boolean skip = false;
                while (abc.Read())
                {
                    data_id = abc.GetValue(0).ToString();
                    
                    String[] l= new string[3]{ "0","0","0"};
                    if (abc.GetValue(4).ToString() == "Coconut" )
                    {
                         l = abc.GetValue(8).ToString().Split('-', '=');
                         if (l.Length != 3)
                         {
                             l = new string[3] { "0", "0", "0" };
                            // this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] {  "Data Type Error" });
                             this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { abc.GetValue(0).ToString() + " No of Nuts Skipped" });
                       
                           //  skip = true;
                            // goto NotFound;

                         }
                    }
                    string supplier_code = "";
                   if(string .IsNullOrEmpty(abc .GetValue (5).ToString()))
                   {
                       supplier_code = "NA";
                   }
                   else
                   {
                       supplier_code=abc .GetValue (5).ToString();
                   }
                    String received_date_time = format_date(abc.GetValue(11).ToString());
                    String exit_date_time = format_date(abc.GetValue(12).ToString()); ;

                    String insSQL = "INSERT INTO weigh_bills (product,supplier_name,supplier_code,bill_no,received_date_time,exit_date_time,truck_no,truck_driver,first_weight,second_weight,total_qty,bad_qty,accepted_qty,w_b_operator) VALUES ('" + abc.GetValue(4) + "', '" + abc.GetValue(3) + "','" + supplier_code + "','" + abc.GetValue(0) + "','" + received_date_time + "','" + exit_date_time + "','" + abc.GetValue(2) + "','" + abc.GetValue(6) + "','" + abc.GetValue(13) + "','" + abc.GetValue(14) + "','" + l.GetValue(0) + "','" + l.GetValue(1) + "','" + l.GetValue(2) + "','" + abc.GetValue(7) + "')";
                    mysqlobj.insert_data(insSQL);

                   // string[] lines = { abc.GetValue(0).ToString() };
                   // System.IO.File.WriteAllLines(AppDomain.CurrentDomain.BaseDirectory + "\\lastID.txt", lines);
                   
                   
                    this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "synchronized. product  is :-" + abc.GetValue(4) });
               // NotFound:
                  //  if (skip == true)
                  //  {
                  //      this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { abc.GetValue(0).ToString() + " No of Nuts Skipped" });
                   //     skip = false;
                  //  }
                
                set_last_id(data_id);
           
                    rowcount++;
                }

                if (rowcount == 0)
                {
                    this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Data Not Available " });
                   
                }
                mysqlobj.mysql_closeDB();
                abc.Close();
                obj.closeDB();
                call_flag = 1;

            }
            catch (System.IndexOutOfRangeException )
            {
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "Null Data Available" });
                set_last_id(data_id);
            }
            catch (Exception ex)
            {
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "synchronized Error " + ex });

                call_flag = 0;
            }
            
            finally
            {
                

            }

        }

        public void function_call()
        {
            string result = null;
            string link = txt_request_link.Text;
            if (checkBox_fun_disable.Checked)
            {
                this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { "GRN Synchronize Disable " });
                call_flag = 0;
            }
            else{
                try
                {


                    System.Net.WebRequest req = System.Net.WebRequest.Create(link);

                    req.Timeout = 5000;
                    System.Net.WebResponse resp = req.GetResponse();


                    System.IO.StreamReader sr = new System.IO.StreamReader(resp.GetResponseStream());
                    result = sr.ReadToEnd().Trim();

                    string[] msg = result.ToString().Split(':', '"');
                    this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { msg[10] });

                    resp.Close();
                    sr.Close();
                    call_flag = 0;
                }
                catch (Exception ex)
                {

                    this.Invoke(new UpdateTerminal1(UpdateTerminal), new Object[] { " Error " + ex.Message });

                    call_flag = 1;
                }
            }
        }

        private void btn_browse_Click(object sender, EventArgs e)
        {
          
            OpenFileDialog op = new OpenFileDialog();
            op.Filter = "Access Database|*.mdb;*.accdb";
            //op.Filter = "*.mdb,*.accdb";
            if (op.ShowDialog() == System.Windows.Forms.DialogResult.OK)
            {
                txt_access_path.Text = op.FileName;
            }

        }

        private void btn_save_Click(object sender, EventArgs e)
        {
            string disable_sync, disable_button;
            if (checkBox_fun_disable.Checked)
            {
                disable_sync = "1";
            }
            else
            {
                disable_sync = "0";
            }
            if (checkBox_btn_hide.Checked)
                disable_button = "1";
            else
                disable_button = "0";

            string[] lines = { txt_access_path.Text, txt_access_password.Text, txt_nex_server.Text, txt_nex_database.Text, txt_nex_port.Text, txt_nex_username.Text, txt_nex_password.Text,txt_request_link.Text,disable_sync,disable_button};
            // WriteAllLines creates a file, writes a collection of strings to the file,
            // and then closes the file.  You do NOT need to call Flush() or Close().
            try
            {
                System.IO.File.WriteAllLines(AppDomain.CurrentDomain.BaseDirectory + "\\settings.txt", lines);
                if (database_status())
                {
                    set_last_id();
                    timer1.Enabled = true;
                }
                MessageBox.Show("Save successfully");

            }
            catch(System.IO.IOException ex)
            {
                MessageBox.Show(" ERROR "+ex);
            }
        }

        public void UpdateTerminal(String str)
        {
            txtTerminal.Text += str + Environment.NewLine;
            txtTerminal.SelectionStart = txtTerminal.TextLength;
            txtTerminal.ScrollToCaret();
           

        }

        private void button1_Click(object sender, EventArgs e)
        {
            sync_database();
        }
       
        private void btn_cancel_Click(object sender, EventArgs e)
        {
            panel_login.Visible = false;
            lbl_login_msg.Text = "";
            txt_username.Text = "";
            txt_password.Text = "";


        }

        private void btn_login_Click(object sender, EventArgs e)
        {
            login();
        }
        private void login()
        {
            if (txt_username.Text == "nexsoft" && txt_password.Text == "123")
            {
                panel_login.Visible = false;
                panel_settings.Visible = true;
                panel_settings.BringToFront();

                panel_settings.Height = 392;
                panel_settings.Width = 498;
                // getDBSettings();
                lbl_login_msg.Text = "";
                txt_username.Text = "";
                txt_password.Text = "";
            }
            else
            {
                lbl_login_msg.Text = "LOGIN ERROR";
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            function_call();
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            if(call_flag==0)
            sync_database();
            else if(call_flag==1)
                function_call();
        }

        private void checkBox_btn_hide_CheckStateChanged(object sender, EventArgs e)
        {
            if (checkBox_btn_hide.Checked)
            {
                button1.Visible = false;
                button2.Visible = false;
                checkBox_btn_hide.Text = "Button Show";
            }
            else
            {
                button1.Visible = true;
                button2.Visible = true;
                checkBox_btn_hide.Text = "Button Hide";
            }
        }

        private void notifyIcon1_MouseDoubleClick(object sender, MouseEventArgs e)
        {
            try
            {
                this.ShowInTaskbar = true;
                notifyIcon1.Visible = false;
                // this.WindowState = FormWindowState.Maximized;
                this.WindowState = FormWindowState.Normal;
                this.Show();

               

            }
            catch (Exception ex)
            {
                MessageBox.Show("" + ex + "");
            }
        }

        private void Form1_Resize(object sender, EventArgs e)
        {
            try
            {
                if (FormWindowState.Minimized == this.WindowState)
                {
                    this.ShowInTaskbar = false;
                    notifyIcon1.Visible = true;
                    notifyIcon1.ShowBalloonTip(50);
                    //  this.Hide();


                }
                else if (FormWindowState.Normal == this.WindowState)
                {
                    notifyIcon1.Visible = false;
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show(""+ex);
                Application.Exit();
            }
        }

        private void checkBox_btn_hide_CheckedChanged(object sender, EventArgs e)
        {

        }

        private void checkBox_fun_disable_CheckedChanged(object sender, EventArgs e)
        {

            if (checkBox_fun_disable.Checked)
            {
                checkBox_fun_disable.Text = "Enable GRN SYNC";
            }
            else
            {

                
                checkBox_fun_disable.Text = "Disable  GRN SYNC";
            }
        }

        private void notifyIcon1_MouseClick(object sender, MouseEventArgs e)
        {
          //  MessageBox.Show("test");
        }

        private void txt_password_KeyPress(object sender, KeyPressEventArgs e)
        {
            if (e.KeyChar == (char)13)
            {
                login();
            }
        }


       
    }
}
