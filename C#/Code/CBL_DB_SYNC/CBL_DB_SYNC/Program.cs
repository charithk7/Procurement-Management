using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading;
using System.Windows.Forms;
using System.Diagnostics;
using System.Runtime.InteropServices;

namespace CBL_DB_SYNC
{
    static class Program
    {
        private static bool isNew;
        [DllImport("user32.dll")]
        private static extern bool SetForegroundWindow(IntPtr hWnd);
        /// <summary>
        /// The main entry point for the application.
        /// </summary>
        [STAThread]
        static void Main()
        {
/*
              if (mutex.WaitOne(TimeSpan.Zero, true))
            {
                try
                {
            Application.EnableVisualStyles();
            Application.SetCompatibleTextRenderingDefault(false);
            Application.ThreadException += new

           ThreadExceptionEventHandler(Application_ThreadException);
            AppDomain.CurrentDomain.UnhandledException += new UnhandledExceptionEventHandler(CurrentDomain_UnhandledException);


            Application.Run(new Form1());
                }
                finally
                {
                    mutex.ReleaseMutex();
                }
            }

                  */

            using (var m = new Mutex(true, "CBL_DB_SYNC", out isNew))
            {
                //If application owns the mutex, continue the execution
                if (isNew)
                {
                    Application.EnableVisualStyles();
                    Application.SetCompatibleTextRenderingDefault(false);
                    Application.Run(new Form1());
                }
                  else
                {
                    MessageBox.Show("Application already running");
                    Process current = Process.GetCurrentProcess();
                    foreach (Process process in Process.GetProcessesByName(current.ProcessName))
                    {
                        if (process.Id != current.Id)
                        {
                            SetForegroundWindow(process.MainWindowHandle);
                            break;
                        }
                    }
                }
             }

             /* else
              {
                  MessageBox.Show(" System Already Running ..... Please check Notification Area ", "System Already Running ...", MessageBoxButtons.OK, MessageBoxIcon.Stop);
                  Application.Exit();
                  // MessageBox.Show("System Already Running ..... Please check Notification Area");
              }*/

        }
     /*   static void Application_ThreadException(object sender, ThreadExceptionEventArgs e)
        {
            MessageBox.Show(e.Exception.Message, "Unhandled Thread Exception");
            Application.Exit();
            // here you can log the exception ...
        }

        static void CurrentDomain_UnhandledException(object sender, UnhandledExceptionEventArgs e)
        {
            MessageBox.Show((e.ExceptionObject as Exception).Message, "Unhandled UI Exception");
            Application.Exit();


            // here you can log the exception 

        }*/
    }
}
